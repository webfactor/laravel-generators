<?php

namespace Webfactor\Laravel\Generators\Traits;

trait CrudField
{
    private $field = [];

    protected $crudFieldType;

    protected $crudFieldOptions = [];

    public function getCrudField(): array
    {
        $this->field['name'] = $this->name;
        $this->field['label'] = $this->name;
        $this->field['type'] = $this->crudFieldType;

        if ($this->crudFieldOptions) {
            $this->addCrudFieldOptions();
        }

        return $this->field;
    }

    private function addCrudFieldOptions()
    {
        foreach ($this->crudFieldOptions as $key => $option) {
            $this->field[$key] = $option;
        }
    }

    private function setCrudFieldOptions(string $crudFieldOptions)
    {
        $crudFieldOptions = explode('|', $crudFieldOptions);

        foreach ($crudFieldOptions as $crudFieldOption) {
            $option = explode(':', $crudFieldOption);
            $this->crudFieldOptions[$option[0]] = $option[1];
        }
    }
}
