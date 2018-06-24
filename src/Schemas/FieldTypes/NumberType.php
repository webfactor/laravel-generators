<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class NumberType extends SchemaFieldAbstract
{
    public $validationRule = 'required|integer';

    public $migrationField = [
        'type' => 'integer',
    ];

    public $crudColumn = [
        'type' => 'number',
    ];

    public $crudField = [
        'type' => 'number',
    ];
}
