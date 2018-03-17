<?php

return [
    /*
     * Services that should be applied by make:entity as default. The classes for 'service'
     * have to implement Webfactor\Laravel\Generators\Contracts\MakeServiceInterface and
     * conversion uses Webfactor\Laravel\Generators\Contracts\ConversionNameInterface.
     */
    'services' => [
        Webfactor\Laravel\Generators\Services\MakeMigrationService::class => [
            'name_conversion' => Webfactor\Laravel\Generators\Services\Conversion\MigrationName::class,
            'schema' => 'name:string',
        ],
        Webfactor\Laravel\Generators\Services\MakeFactoryService::class => [
            'name_conversion' => Webfactor\Laravel\Generators\Services\Conversion\FactoryName::class,
        ],
        Webfactor\Laravel\Generators\Services\MakeSeederService::class => [
            'name_conversion' => Webfactor\Laravel\Generators\Services\Conversion\SeederName::class,
        ],
        Webfactor\Laravel\Generators\Services\MakeBackpackCrudService::class => [
            'name_conversion' => Webfactor\Laravel\Generators\Services\Conversion\BackpackCrudName::class,
        ],
    ],
];
