<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        /*
        |--------------------------------------------------------------------------
        | Make sure the user is logged in.
        |--------------------------------------------------------------------------
        */

        if (!$request->user()) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | Make sure the logged-in user is an admin.
        |--------------------------------------------------------------------------
        */

        if ($request->user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}