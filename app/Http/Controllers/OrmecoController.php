<?php

namespace App\Http\Controllers;

use App\Models\OrmecoAccount;
use App\Models\OrmecoBill;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class OrmecoController extends Controller
{
    /**
     * Show the ORMECO payment page.
     */
    public function index()
    {
        return view('ormeco.index');
    }

    /**
     * Find an ORMECO account using the account number.
     */
    public function lookup(Request $request)
    {
        $request->validate([
            'account_number' => [
                'required',
                'string',
                'max:50',
            ],
        ]);

        $account = OrmecoAccount::where(
            'account_number',
            $request->account_number
        )
            ->where('user_id', Auth::id())
            ->with([
                'bills' => function ($query) {
                    $query->where('status', 'unpaid')
                        ->latest();
                },
            ])
            ->first();

        if (!$account) {
            return back()
                ->withInput()
                ->with('error', 'ORMECO account not found.');
        }

        $bill = $account->bills->first();

        if (!$bill) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'No unpaid ORMECO bill was found for this account.'
                );
        }

        return view('ormeco.bill', compact('account', 'bill'));
    }

    /**
     * Pay an ORMECO bill using the user's AMEPSO wallet.
     */
    public function pay(
        OrmecoBill $bill,
        WalletService $walletService
    ) {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Make sure the bill belongs to the logged-in user.
        |--------------------------------------------------------------------------
        */

        $bill->load('ormecoAccount');

        if ($bill->ormecoAccount->user_id !== $user->id) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent paying an already-paid bill.
        |--------------------------------------------------------------------------
        */

        if ($bill->status !== 'unpaid') {
            return back()->with(
                'error',
                'This bill has already been paid or is no longer available.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Get the user's wallet.
        |--------------------------------------------------------------------------
        */

        $wallet = $user->wallet;

        if (!$wallet) {
            return back()->with(
                'error',
                'Your AMEPSO wallet could not be found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Process the payment.
        |--------------------------------------------------------------------------
        */

        try {
            DB::transaction(function () use (
                $bill,
                $wallet,
                $walletService
            ) {
                /*
                |--------------------------------------------------------------------------
                | Deduct the bill amount from the wallet.
                |--------------------------------------------------------------------------
                */

                $walletService->debit(
                    $wallet,
                    (float) $bill->amount,
                    'bill_payment',
                    'ORMECO Bill ' . $bill->bill_number
                );

                /*
                |--------------------------------------------------------------------------
                | Mark the ORMECO bill as paid.
                |--------------------------------------------------------------------------
                */

                $bill->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);
            });
        } catch (RuntimeException $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }

        return redirect()
            ->route('ormeco.receipt', $bill)
            ->with(
                'success',
                'ORMECO bill payment completed successfully.'
            );
    }

    /**
     * Display the payment receipt.
     */
    public function receipt(OrmecoBill $bill)
    {
        $bill->load('ormecoAccount');

        if ($bill->ormecoAccount->user_id !== Auth::id()) {
            abort(403);
        }

        return view('ormeco.receipt', compact('bill'));
    }
}