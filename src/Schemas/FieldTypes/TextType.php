<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class TextType extends SchemaFieldAbstract
{
    public $validationRule = 'required';

    public $migrationField = [
        'type' => 'text',
    ];

    public $crudColumn = [
        'type' => 'text',
    ];

    public $crudField = [
        'type' => 'text',
    ];
}
