<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class DateType extends SchemaFieldAbstract
{
    public $validationRule = 'required|date';

    public $crudColumn = [
        'type' => 'date',
    ];

    public $crudField = [
        'type' => 'date',
    ];
}
