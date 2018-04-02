<?php

return [
    /*
     * Services that should be applied by make:entity as default. The classes for 'service'
     * have to implement Webfactor\Laravel\Generators\Contracts\MakeServiceInterface.
     */
    'services' => [
        Webfactor\Laravel\Generators\Services\MigrationService::class,
        Webfactor\Laravel\Generators\Services\LanguageService::class,
        Webfactor\Laravel\Generators\Services\BackpackCrudModelService::class,
        Webfactor\Laravel\Generators\Services\BackpackCrudControllerService::class,
        Webfactor\Laravel\Generators\Services\BackpackCrudRequestService::class,
        Webfactor\Laravel\Generators\Services\FactoryService::class,
        Webfactor\Laravel\Generators\Services\SeederService::class,
        Webfactor\Laravel\Generators\Services\RouteService::class,
        Webfactor\Laravel\Generators\Services\SidebarService::class,
        Webfactor\Laravel\Generators\Services\OpenIdeService::class,
    ],

    /*
     * Recipe classes for opening all generated files directly in IDE if the option --ide={key}
     * is used. Have to implement Webfactor\Laravel\Generators\Contracts\OpenIdeInterface.
     */
    'ides'     => [
        'pstorm' => Webfactor\Laravel\Generators\Recipes\PhpStormOpener::class,
    ],

    'naming' => [
        'migration' => \Webfactor\Laravel\Generators\Schemas\Naming\Migration::class,
        'model' => \Webfactor\Laravel\Generators\Schemas\Naming\CrudModel::class,
        'request' => \Webfactor\Laravel\Generators\Schemas\Naming\Request::class,
        'controller' => \Webfactor\Laravel\Generators\Schemas\Naming\CrudController::class,
    ]
];
