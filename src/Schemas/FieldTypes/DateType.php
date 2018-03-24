<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\MigrationFieldAbstract;

class DateType extends MigrationFieldAbstract
{
    protected $validationRuleType = 'date';

    protected $crudColumnType = 'date';

    protected $crudFieldType = 'date';
}
