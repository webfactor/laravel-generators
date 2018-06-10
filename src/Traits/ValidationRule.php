<?php

namespace Webfactor\Laravel\Generators\Traits;

trait ValidationRule
{
    protected $validationRuleType;

    protected $validationRuleOptions = [];

    public function getValidationRule(): string
    {
        return 'required|' . $this->validationRuleType;

        /*if ($this->crudFieldOptions) {
            $this->addCrudFieldOptions();
        }

        return $this->field;*/
    }
}
