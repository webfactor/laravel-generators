<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\MigrationFieldAbstract;

class IntegerType extends MigrationFieldAbstract
{
    protected $validationRule = 'required|integer';

    protected $crudColumn = [
        'type' => 'number',
    ];

    protected $crudField = [
        'type' => 'number',
    ];
}
