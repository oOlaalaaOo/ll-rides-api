<?php

namespace Modules\ShopModule;

use Illuminate\Support\ServiceProvider;

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
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->loadFactoriesFrom(__DIR__.'/Database/Factories');
        $this->loadRoutesFrom(__DIR__.'/Routes.php');
    }
}
