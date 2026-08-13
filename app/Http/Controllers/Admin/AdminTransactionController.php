<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTransactionController extends Controller
{
    /**
     * Display wallet transactions.
     */
    public function index(Request $request): View
    {
        $type = $request->input('type');

        $transactions = WalletTransaction::with(
            'wallet.user'
        )
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.transactions.index', compact(
            'transactions',
            'type'
        ));
    }
}