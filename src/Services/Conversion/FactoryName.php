<?php

namespace Webfactor\Laravel\Generators\Services\Conversion;

use Webfactor\Laravel\Generators\Contracts\ConversionNameInterface;

class FactoryName implements ConversionNameInterface
{
    public static function getName(string $entity)
    {
        return ucfirst($entity) . 'Factory';
    }
}
