<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


    /**
     * Update a user's role.
     */
    public function updateRole(
        Request $request,
        User $user
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Validate requested role
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'role' => [
                'required',
                'in:user,admin',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Get currently logged-in user's ID
        |--------------------------------------------------------------------------
        */

        $currentUserId = Auth::id();


        /*
        |--------------------------------------------------------------------------
        | Prevent admin from removing their own admin access
        |--------------------------------------------------------------------------
        */

        if (
            $user->getKey() === $currentUserId &&
            $validated['role'] !== 'admin'
        ) {
            return back()->with(
                'error',
                'You cannot remove your own administrator access.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Update role
        |--------------------------------------------------------------------------
        */

        $user->role = $validated['role'];

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | Success message
        |--------------------------------------------------------------------------
        */

        if ($validated['role'] === 'admin') {

            return back()->with(
                'success',
                $user->name .
                ' has been promoted to administrator.'
            );
        }


        return back()->with(
            'success',
            $user->name .
            ' has been changed to a regular user.'
        );
    }
}