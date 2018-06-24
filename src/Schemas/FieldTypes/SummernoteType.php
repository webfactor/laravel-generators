<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class SummernoteType extends SchemaFieldAbstract
{
    public $validationRule = '';

    public $migrationField = [
        'type' => 'text',
    ];

    public $crudColumn = [
        'type' => 'text',
    ];

    public $crudField = [
        'type' => 'summernote',
    ];
}
