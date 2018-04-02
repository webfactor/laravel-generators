<?php

namespace Webfactor\Laravel\Generators\Schemas;

class NamingSchema
{
    public $migration;

    public $model;

    public $request;

    public $controller;

    public $route;

    public $factory;

    public $seeder;

    public function __construct(string $entity)
    {
        $naming = config('webfactor.generators.naming');

        $this->migration = new $naming['migration']($entity);
        $this->model = new $naming['model']($entity);
        $this->request = new $naming['request']($entity);
        $this->controller = new $naming['controller']($entity);
    }
}
