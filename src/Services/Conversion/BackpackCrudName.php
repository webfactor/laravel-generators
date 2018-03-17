<?php

namespace Webfactor\Laravel\Generators\Services\Conversion;

use Webfactor\Laravel\Generators\Contracts\ConversionNameInterface;

class BackpackCrudName implements ConversionNameInterface
{
    public static function getName(string $entity)
    {
        return ucfirst($entity);
    }
}
