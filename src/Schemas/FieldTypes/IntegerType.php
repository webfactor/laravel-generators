<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\MigrationFieldAbstract;

class IntegerType extends MigrationFieldAbstract
{
    protected $validationRule = 'required|integer';

    protected $crudColumnType = 'number';

    protected $crudFieldType = 'number';
}
