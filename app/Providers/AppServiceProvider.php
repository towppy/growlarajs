<?php
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\RedirectResponse;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, function () {
            return new class implements LoginResponseContract {
                public function toResponse($request): RedirectResponse
                {
                    return redirect()->intended(
                        auth()->user()->is_admin ? route('admin.dashboard') : route('user.dashboard')
                    );
                }
            };
        });
    }

    public function boot(): void
    {
        //
    }
}
