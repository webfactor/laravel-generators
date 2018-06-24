<?php

namespace Webfactor\Laravel\Generators;

use Illuminate\Support\ServiceProvider;
use Webfactor\Laravel\Generators\Commands\MakeBackpackCrudController;
use Webfactor\Laravel\Generators\Commands\MakeBackpackCrudModel;
use Webfactor\Laravel\Generators\Commands\MakeBackpackCrudRequest;
use Webfactor\Laravel\Generators\Commands\MakeEntity;

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
                MakeEntity::class,
            ]);

            $this->publishes([
                __DIR__ . '/../config/generators.php' => config_path('webfactor/generators.php'),
            ], 'config');
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../config/generators.php', 'webfactor.generators'
        );
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
