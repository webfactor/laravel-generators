<?php

namespace Webfactor\Laravel\Generators\Traits;

trait CrudField
{
    public $crudField = [
        'type' => 'text',
    ];

    public function getCrudField(): array
    {
        return $this->crudField;
    }

    private function setCrudFieldOptions(string $crudFieldOptions)
    {
        $this->setOptions('crudField', $crudFieldOptions);
    }
}
