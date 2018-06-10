<?php

namespace Webfactor\Laravel\Generators\Schemas;

class NamingSchema
{
    public function __construct(string $entity)
    {
        foreach (config('webfactor.generators.naming') as $naming) {
            $namingObject = new $naming($entity);

            $this->{$namingObject->key} = $namingObject;
        }
    }
}
