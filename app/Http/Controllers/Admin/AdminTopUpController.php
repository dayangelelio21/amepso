<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopUp;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTopUpController extends Controller
{
    /**
     * Display AMEPSO top-up records.
     */
    public function index(Request $request): View
    {
        $status = $request->input('status');

        $topUps = TopUp::with('user')
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.topups.index', compact(
            'topUps',
            'status'
        ));
    }
}