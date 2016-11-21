<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class for the admin check middleware
 */
class AdminCheck
{
    /**
     * checks if the user is a user and then if they are an admin, if both true request is allowed to continue. If false user is redirect to the home page.
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->administrator) return $next($request);
        return redirect('/');
    }
}
