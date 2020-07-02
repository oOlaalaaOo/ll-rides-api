<?php

namespace LaaLaa\CrudGenerator;

use Illuminate\Support\ServiceProvider;
use LaaLaa\CrudGenerator\Console\Commands\GenerateCrudCommand;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateCrudCommand::class,
            ]);
        }
    }
}
