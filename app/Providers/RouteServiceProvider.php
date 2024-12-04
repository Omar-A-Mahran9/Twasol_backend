<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        Route::bind('role', function($id) {
            return Role::withoutGlobalScopes()->findOrFail($id);
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace("$this->namespace\\Api")
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth:admin', 'set_locale'])
                ->namespace("App\\Http\\Controllers\\Dashboard")
                ->name('dashboard.')
                ->prefix('dashboard')
                ->group(base_path('routes/dashboard.php'));

            Route::middleware(['web', 'auth:vendor', 'set_locale'])
                ->namespace("App\\Http\\Controllers\\Vendor")
                ->name('vendor.')
                ->prefix('vendor')
                ->group(base_path('routes/vendor.php'));
        });
    }
}
