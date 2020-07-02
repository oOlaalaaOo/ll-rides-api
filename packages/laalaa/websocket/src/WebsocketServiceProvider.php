<?php

namespace LaaLaa\Websocket;

use Illuminate\Support\ServiceProvider;
use LaaLaa\Websocket\Console\Commands\WebsocketServerCommand;

class WebsocketServiceProvider extends ServiceProvider
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
                WebsocketServerCommand::class,
            ]);
        }
    }
}
