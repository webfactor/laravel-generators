<?php

namespace Webfactor\Laravel\Generators\Schemas;

class ValidationRule
{
    private $type;

    private $field;

    private $required = true;

    public function __construct(MigrationField $migrationField)
    {
        if ($migrationField->isNullable()) {
            $this->required = false;
        }

        $this->type = $migrationField->getType();
        $this->field = $migrationField->getName();
    }

    public function generateRuleString(): ?string
    {
        if ($this->isRequired()) {
            return 'required';
        }

        return null;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }
}
