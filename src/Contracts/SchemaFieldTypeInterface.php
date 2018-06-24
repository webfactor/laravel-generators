<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Webfactor\Laravel\Generators\Traits\CrudColumn;
use Webfactor\Laravel\Generators\Schemas\CrudField;
use Webfactor\Laravel\Generators\Schemas\RequestValidationRule;

interface SchemaFieldTypeInterface
{
    public function getValidationRule(): string;

    public function getCrudColumn(): array;

    public function getCrudField(): array;
}
