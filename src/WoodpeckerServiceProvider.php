<?php

namespace WindfallInc\Woodpecker;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class WoodpeckerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
     public function boot(\Illuminate\Routing\Router $router)
     {
         $this->loadViewsFrom(base_path('resources/views/windfallInc/woodpecker'), 'woodpecker');
         $this->publishes([
        __DIR__.'/views' => base_path('resources/views'),
        __DIR__.'/less' => base_path('resources/assets/less'),
        __DIR__.'/controller' => base_path('app/Http/Controllers'),
        __DIR__.'/Models' => base_path('app/Woodpecker'),
        __DIR__.'/migrations' => base_path('database/migrations'),
        __DIR__.'/Middleware' => base_path('app/Http/Middleware'),
        __DIR__.'/Notifications' => base_path('app/Notifications'),
        __DIR__.'/assets' => base_path('public'),
        __DIR__.'/config' => base_path('config'),
    ], 'woodpecker');
        $this->publishes([
       __DIR__.'/views/dashboard' => base_path('resources/views/dashboard'),
       __DIR__.'/less/woodpecker/adminstyle.less' => base_path('resources/assets/less/woodpecker/adminstyle.less'),
       __DIR__.'/less/woodpecker/animation.less' => base_path('resources/assets/less/woodpecker/animation.less'),
       __DIR__.'/less/woodpecker/base.less' => base_path('resources/assets/less/woodpecker/base.less'),
       __DIR__.'/less/woodpecker/component.less' => base_path('resources/assets/less/woodpecker/component.less'),
       __DIR__.'/less/woodpecker/navigation.less' => base_path('resources/assets/less/woodpecker/navigation.less'),
       __DIR__.'/less/woodpecker/options.less' => base_path('resources/assets/less/woodpecker/options.less'),
       __DIR__.'/less/woodpecker/style.less' => base_path('resources/assets/less/woodpecker/style.less'),
       __DIR__.'/controller' => base_path('app/Http/Controllers'),
       __DIR__.'/Models' => base_path('app/Woodpecker'),
       __DIR__.'/migrations' => base_path('database/migrations'),
       __DIR__.'/Middleware' => base_path('app/Http/Middleware'),
       __DIR__.'/Notifications' => base_path('app/Notifications'),
       __DIR__.'/assets/js' => base_path('public/assets/js'),
    ],'woodpeckerupdate');
        $router->aliasMiddleware('dashboard', \App\Http\Middleware\RedirectIfNotDashboard::class);
        $router->aliasMiddleware('dashboard.guest', \App\Http\Middleware\RedirectIfDashboard::class);
        $this->app->register('WindfallInc\Woodpecker\WoodpeckerRouteServiceProvider');
        Schema::defaultStringLength(191);
     }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        include __DIR__.'/routes.php';
       $this->app->make('WindfallInc\Woodpecker\WoodpeckerController');
    }
}
