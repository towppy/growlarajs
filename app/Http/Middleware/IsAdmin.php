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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  public function handle($request, Closure $next)
{
    if (auth()->check()) {
        \Log::info('IsAdmin middleware', [
            'user_id' => auth()->user()->id,
            'is_admin' => auth()->user()->is_admin
        ]);
        if (auth()->user()->is_admin) {
            return $next($request);
        }
    }
    \Log::info('IsAdmin failed', [
        'user' => auth()->user()
    ]);
    abort(403, 'You are not authorized to access the admin dashboard.');
}

}
