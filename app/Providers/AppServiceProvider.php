<?php

namespace App\Providers;

use App\Domains\Shared\v1\Contracts\Services\AccessSecurityServiceContract;
use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Domains\Shared\v1\Services\Auth\AccessSecurityService;
use App\Domains\Shared\v1\Services\Otp\FakeOtpService;
use App\Domains\Shared\v1\Services\Otp\OtpService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::bind(OtpServiceContract::class, function () {
            if (App::environment('live')) {
                return new OtpService();
            } else {
                return new FakeOtpService   ();
            }

        });
        App::bind(AccessSecurityServiceContract::class, function () {
            return new AccessSecurityService();
        });
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('admin.v1.components.layout.partials.ubold-paginator');
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_vendor') ? true : null;
        });
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });

        Schema::defaultStringLength(191);
    }
}
