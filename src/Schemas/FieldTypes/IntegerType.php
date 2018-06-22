<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class IntegerType extends SchemaFieldAbstract
{
    protected $validationRule = 'required|integer';

    protected $crudColumn = [
        'type' => 'number',
    ];

    protected $crudField = [
        'type' => 'number',
    ];
}
