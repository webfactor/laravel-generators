<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class JsonType extends SchemaFieldAbstract
{
    public $validationRule = 'required';

    public $crudColumn = [
        'type' => 'text',
    ];

    public $crudField = [
        'type' => 'summernote',
    ];
}
