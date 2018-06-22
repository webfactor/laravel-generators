<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class DateType extends SchemaFieldAbstract
{
    protected $validationRule = 'required|date';

    protected $crudColumn = [
        'type' => 'date',
    ];

    protected $crudField = [
        'type' => 'date',
    ];
}
