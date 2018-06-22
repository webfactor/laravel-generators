<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class BooleanType extends SchemaFieldAbstract
{
    public $validationRule = 'required|boolean';

    public $crudColumn = [
        'type' => 'boolean',
    ];

    public $crudField = [
        'type' => 'boolean',
    ];
}
