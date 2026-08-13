<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrmecoAccount;
use App\Models\OrmecoBill;
use Illuminate\Http\Request;

class OrmecoBillController extends Controller
{
    /**
     * Show all ORMECO bills.
     */
    public function index()
    {
        $bills = OrmecoBill::with('ormecoAccount')
            ->latest()
            ->paginate(10);

        return view('admin.ormeco-bills.index', compact('bills'));
    }

    /**
     * Show create bill form.
     */
    public function create()
    {
        $accounts = OrmecoAccount::with('user')
            ->orderBy('account_name')
            ->get();

        return view('admin.ormeco-bills.create', compact('accounts'));
    }

    /**
     * Store a new ORMECO bill.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ormeco_account_id' => ['required', 'exists:ormeco_accounts,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'billing_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:billing_date'],
        ]);

        $year = now()->year;

        $lastBill = OrmecoBill::whereYear('created_at', $year)
            ->latest('id')
            ->first();

        $nextNumber = $lastBill
            ? ((int) substr($lastBill->bill_number, -4)) + 1
            : 1;

        $billNumber = 'ORMECO-' . $year . '-' . str_pad(
            $nextNumber,
            4,
            '0',
            STR_PAD_LEFT
        );

        OrmecoBill::create([
            'ormeco_account_id' => $validated['ormeco_account_id'],
            'bill_number' => $billNumber,
            'amount' => $validated['amount'],
            'billing_date' => $validated['billing_date'],
            'due_date' => $validated['due_date'],
            'status' => 'unpaid',
        ]);

        return redirect()
            ->route('admin.ormeco-bills.index')
            ->with('success', 'ORMECO bill created successfully.');
    }
}