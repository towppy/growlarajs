<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_admin) {
            \Log::info('✅ IsAdmin passed', [
                'user_id' => auth()->user()->id,
                'is_admin' => auth()->user()->is_admin
            ]);

            return $next($request);
        }

        \Log::warning('❌ IsAdmin failed', [
            'user' => auth()->user()
        ]);

        abort(403, 'You are not authorized to access the admin dashboard.');
    }
}
