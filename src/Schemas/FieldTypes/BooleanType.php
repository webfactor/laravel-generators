<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class BooleanType extends SchemaFieldAbstract
{
    protected $validationRule = 'required|boolean';

    protected $crudColumn = [
        'type' => 'boolean',
    ];

    protected $crudField = [
        'type' => 'boolean',
    ];
}
