<?php

namespace Webfactor\Laravel\Generators\Traits;

trait CrudField
{
    protected $crudField = [
        'type' => 'text',
    ];

    public function getCrudField(): array
    {
        return $this->crudField;
    }

    private function setCrudFieldOptions(string $crudFieldOptions)
    {
        $this->crudField['name'] = $this->name;

        foreach (explode('|', $crudFieldOptions) as $crudFieldOption) {
            $option = explode(':', $crudFieldOption);
            $this->crudField[$option[0]] = $option[1];
        }
    }
}
