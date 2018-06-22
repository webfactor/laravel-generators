<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;

class TextType extends SchemaFieldAbstract
{
    protected $validationRule = 'required';

    protected $crudColumn = [
        'type' => 'text',
    ];

    protected $crudField = [
        'type' => 'summernote',
    ];
}
