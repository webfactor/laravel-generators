<?php

namespace Webfactor\Laravel\Generators;

use Illuminate\Support\ServiceProvider;
use Webfactor\Laravel\Generators\Commands\MakeCrudEntity;

class GeneratorsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCrudEntity::class,
            ]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
