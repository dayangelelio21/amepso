<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrmecoBill;
use App\Models\TopUp;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Display the Admin Dashboard.
     */
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | Basic Statistics
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();

        $totalWalletBalance = Wallet::sum('balance');

        $totalTopUps = TopUp::count();

        $totalTopUpAmount = TopUp::where(
            'status',
            'completed'
        )->sum('amount');

        $totalTransactions = WalletTransaction::count();

        $totalTransactionAmount = WalletTransaction::where(
            'status',
            'completed'
        )->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | ORMECO Statistics
        |--------------------------------------------------------------------------
        */

        $totalOrmecoBills = OrmecoBill::count();

        $paidOrmecoBills = OrmecoBill::where(
            'status',
            'paid'
        )->count();

        $unpaidOrmecoBills = OrmecoBill::where(
            'status',
            'unpaid'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Recent Transactions
        |--------------------------------------------------------------------------
        */

        $recentTransactions = WalletTransaction::with(
            'wallet.user'
        )
            ->latest()
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Top Ups
        |--------------------------------------------------------------------------
        */

        $recentTopUps = TopUp::with(
            'user'
        )
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent ORMECO Bills
        |--------------------------------------------------------------------------
        */

        $recentOrmecoBills = OrmecoBill::with(
            'ormecoAccount.user'
        )
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return Dashboard
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalWalletBalance',
            'totalTopUps',
            'totalTopUpAmount',
            'totalTransactions',
            'totalTransactionAmount',
            'totalOrmecoBills',
            'paidOrmecoBills',
            'unpaidOrmecoBills',
            'recentTransactions',
            'recentTopUps',
            'recentOrmecoBills',
        ));
    }
}