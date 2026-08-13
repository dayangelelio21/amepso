<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrmecoBill;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOrmecoController extends Controller
{
    /**
     * Display ORMECO bills.
     */
    public function index(Request $request): View
    {
        $status = $request->input('status');

        $bills = OrmecoBill::with([
            'ormecoAccount.user',
        ])
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.ormeco.index', compact(
            'bills',
            'status'
        ));
    }
}