<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

class WalletTransactionController extends Controller
{
    /**
     * Show the logged-in user's wallet transaction history.
     */
    public function index()
    {
        $wallet = Auth::user()->wallet;

        if (!$wallet) {
            abort(404, 'Wallet not found.');
        }

        $transactions = WalletTransaction::where('wallet_id', $wallet->id)
            ->latest()
            ->paginate(15);

        return view(
            'transactions.index',
            compact('transactions')
        );
    }

    /**
     * Show details for a single wallet transaction.
     */
    public function show($transaction)
    {
        $wallet = Auth::user()->wallet;

        if (!$wallet) {
            abort(404, 'Wallet not found.');
        }

        $transaction = $wallet->transactions()
            ->whereKey($transaction)
            ->firstOrFail();

        return view(
            'transactions.show',
            compact('transaction')
        );
    }
}