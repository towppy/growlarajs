<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_active) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'Your account has been disabled.',
            ]);
        }

        return $next($request);
    }
}
