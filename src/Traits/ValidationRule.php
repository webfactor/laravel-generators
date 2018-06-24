<?php

namespace Webfactor\Laravel\Generators\Traits;

trait ValidationRule
{
    public $validationRule;

    public function getValidationRule(): string
    {
        return $this->validationRule;
    }

    private function setValidationRule(string $validationRule)
    {
        $this->validationRule = $validationRule;
    }
}
