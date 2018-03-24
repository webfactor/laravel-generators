<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\MigrationFieldAbstract;

class TextType extends MigrationFieldAbstract
{
    protected $validationRuleType = 'text';

    protected $crudColumnType = 'text';

    protected $crudFieldType = 'summernote';
}
