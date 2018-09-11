<?php
namespace WindfallInc\Woodpecker;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class WoodpeckerRouteServiceProvider extends RouteServiceProvider
{
    protected $namespace='App\Http\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapDashboardRoutes();

    }


    /**
     * Define the "dashboard" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapDashboardRoutes()
    {
        Route::group([
            'middleware' => ['web', 'dashboard', 'auth:dashboard'],
            'prefix' => 'dashboard',
            'as' => 'dashboard.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('/vendor/windfallinc/woodpecker/src/dashboard.php');
        });
    }
}
