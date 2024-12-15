<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && !$user->isActive()) {
            Auth::logout(); // Log out the inactive user
            return redirect()->route('login')->with('status', 'Your account is inactive. Please contact support for assistance.');
        }
        if ($user->usertype == 3) {
            return redirect('/appointment');
        }
        if ($user->usertype == 2) {
            return redirect('/dentist/appointment');
        }

        return $next($request);
    }
}
