<?php

namespace Modules\ShopModule;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ShopModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        Route::group([
            'prefix' => 'api',
            'middleware' => 'api',
            'namespace' => 'Modules\ShopModule\Http\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        });
    }
}
