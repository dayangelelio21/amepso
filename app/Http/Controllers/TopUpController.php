<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Services\PayMongoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RuntimeException;

class TopUpController extends Controller
{
    /**
     * Show the top-up page.
     */
    public function index()
    {
        return view('topup.index');
    }

    /**
     * Create a top-up and redirect the user to PayMongo Checkout.
     */
    public function store(
        Request $request,
        PayMongoService $payMongoService
    ) {
        $validated = $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:50',
                'max:50000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create AMEPSO top-up
        |--------------------------------------------------------------------------
        */

        $topUp = TopUp::create([
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'reference' => $this->generateReference(),
            'provider' => 'paymongo',
            'status' => 'pending',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create PayMongo Checkout Session
        |--------------------------------------------------------------------------
        */

        try {
            $checkout = $payMongoService->createCheckoutSession(
                (float) $topUp->amount,
                'AMEPSO Wallet Top Up',
                $topUp->reference
            );
        } catch (RuntimeException $e) {
            return redirect()
                ->route('topup.index')
                ->withInput()
                ->with(
                    'error',
                    'Unable to create the payment checkout. Please try again.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Get PayMongo Checkout URL
        |--------------------------------------------------------------------------
        */

        $checkoutUrl = data_get(
            $checkout,
            'data.attributes.checkout_url'
        );

        $checkoutSessionId = data_get(
            $checkout,
            'data.id'
        );

        if (!$checkoutUrl || !$checkoutSessionId) {
            return redirect()
                ->route('topup.index')
                ->with(
                    'error',
                    'PayMongo returned an invalid checkout response.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Store PayMongo Checkout Session ID
        |--------------------------------------------------------------------------
        */

        $topUp->update([
            'provider_reference' => $checkoutSessionId,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Redirect to PayMongo
        |--------------------------------------------------------------------------
        */

        return redirect()->away($checkoutUrl);
    }

    /**
     * Show top-up details.
     */
    public function show(TopUp $topUp)
    {
        /*
        |--------------------------------------------------------------------------
        | Security: only allow the owner to view this top-up.
        |--------------------------------------------------------------------------
        */

        if ($topUp->user_id !== Auth::id()) {
            abort(403);
        }

        return view('topup.show', compact('topUp'));
    }

    /**
     * Show the logged-in user's top-up history.
     */
    public function history()
    {
        $userId = Auth::id();

        $topUps = TopUp::where('user_id', $userId)
            ->latest()
            ->paginate(10);

        return view('topup.history', compact('topUps'));
    }

    /**
     * Handle the customer's return after PayMongo checkout.
     *
     * IMPORTANT:
     * This does NOT credit the wallet.
     * The PayMongo webhook handles the actual payment confirmation.
     */
    public function success()
    {
        return view('topup.success');
    }

    /**
     * Generate a unique AMEPSO top-up reference.
     */
    private function generateReference(): string
    {
        do {
            $reference =
                'AMP-TOPUP-' .
                now()->format('YmdHis') .
                '-' .
                Str::upper(Str::random(6));

        } while (
            TopUp::where('reference', $reference)->exists()
        );

        return $reference;
    }
}