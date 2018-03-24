<?php

namespace Webfactor\Laravel\Generators\Schemas\FieldTypes;

use Webfactor\Laravel\Generators\Contracts\MigrationFieldAbstract;

class IntegerType extends MigrationFieldAbstract
{
    public function getRule(): string
    {
        return 'required';
    }

    public function getColumn(): array
    {
        return [
            'name' => $this->getName(),
            'label' => $this->getName(),
        ];
    }

    public function getField(): array
    {
        return [
            'name' => $this->getName(),
            'label' => $this->getName(),
        ];
    }
}
