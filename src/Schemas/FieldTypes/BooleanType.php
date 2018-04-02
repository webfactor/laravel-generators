<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\MigrationFieldAbstract;

class BooleanType extends MigrationFieldAbstract
{
    protected $validationRule = 'required|boolean';

    protected $crudColumnType = 'boolean';

    protected $crudFieldType = 'boolean';
}
