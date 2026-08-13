<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    /**
     * Display all AMEPSO users.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $users = User::with('wallet')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact(
            'users',
            'search'
        ));
    }

    /**
     * Display a specific user.
     */
    public function show(User $user): View
    {
        $user->load([
            'wallet.transactions',
            'topUps',
        ]);

        return view('admin.users.show', compact(
            'user'
        ));
    }
}