<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Attempt authentication
        $request->authenticate();

        // Prevent session fixation
        $request->session()->regenerate();

        $user = Auth::user();

        // Log login activity (optional, for debugging)
        \Log::info('User logged in', [
            'user_id' => $user?->id,
            'email' => $user?->email,
            'is_admin' => $user?->is_admin,
        ]);

        // Redirect based on admin status
        if ($user && boolval($user->is_admin)) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        return redirect()->intended(route('user.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Optionally clear all session data
        // $request->session()->flush();

        return redirect('/register'); // Redirect after logout
    }
}
