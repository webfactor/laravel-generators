<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\MigrationFieldAbstract;

class TextType extends MigrationFieldAbstract
{
    protected $validationRule = 'required';

    protected $crudColumn = [
        'type' => 'text',
    ];

    protected $crudField = [
        'type' => 'summernote',
    ];
}
