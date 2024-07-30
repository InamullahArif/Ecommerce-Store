<?php

namespace App\Providers;

use App\Helpers\IUserRole;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            // $this->_mapAdminRoutes();

            // $this->_mapPartnerAdminRoutes();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Mapped Admin Routes
     */
    // private function _mapAdminRoutes()
    // {
    //     Route::middleware(['web','auth'])
    //         ->prefix(IUserRole::SUPER_ADMIN)
    //         ->namespace($this->namespace.'\Web\Admin')
    //         ->group(base_path('routes/super-admin.php'));
    // }

    /**
     * @return void
     */
    // private function _mapPartnerAdminRoutes()
    // {
    //     Route::middleware(['web','auth'])
    //         ->prefix(IUserRole::PARTNER_ADMIN)
    //         ->namespace($this->namespace.'\Web\Admin')
    //         ->group(base_path('routes/partner-admin.php'));
    // }
}
