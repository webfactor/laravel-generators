<?php

namespace Webfactor\Laravel\Generators\Services\Conversion;

use Webfactor\Laravel\Generators\Contracts\ConversionNameInterface;

class MigrationName implements ConversionNameInterface
{
    public static function getName(string $entity)
    {
        return 'create_' . snake_case(str_plural($entity)) . '_table';
    }
}
