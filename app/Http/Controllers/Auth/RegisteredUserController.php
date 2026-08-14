<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OrmecoAccount;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Validate registration
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],

            'ormeco_account_number' => [
                'required',
                'string',
                'max:50',
                'unique:ormeco_accounts,account_number',
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Create user and ORMECO account
        |--------------------------------------------------------------------------
        */

        $user = DB::transaction(function () use ($validated) {

            /*
            | Create AMEPSO user
            */

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'user',
            ]);


            /*
            | Create ORMECO account belonging to this user
            */

            OrmecoAccount::create([
                'user_id' => $user->id,
                'account_number' => $validated['ormeco_account_number'],
                'account_name' => $validated['name'],
                'meter_number' => null,
                'service_address' => null,
            ]);


            return $user;
        });


        /*
        |--------------------------------------------------------------------------
        | Fire registration event
        |--------------------------------------------------------------------------
        */

        event(new Registered($user));


        /*
        |--------------------------------------------------------------------------
        | Automatically log user in
        |--------------------------------------------------------------------------
        */

        Auth::login($user);


        /*
        |--------------------------------------------------------------------------
        | Redirect to dashboard
        |--------------------------------------------------------------------------
        */

        return redirect(
            route('dashboard', absolute: false)
        );
    }
}