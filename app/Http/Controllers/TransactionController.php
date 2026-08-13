<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display the user's transaction history.
     */
    public function index()
    {
        $wallet = Auth::user()->wallet;

        $transactions = $wallet->transactions()
            ->latest()
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }
}
