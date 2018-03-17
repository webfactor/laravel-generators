<?php

namespace Webfactor\Laravel\Generators\Services\Conversion;

use Webfactor\Laravel\Generators\Contracts\ConversionNameInterface;

class SeederName implements ConversionNameInterface
{
    public static function getName(string $entity)
    {
        return ucfirst(str_plural($entity)) . 'Seeder';
    }
}
