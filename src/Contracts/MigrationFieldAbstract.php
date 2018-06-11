<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Webfactor\Laravel\Generators\Traits\CrudColumn;
use Webfactor\Laravel\Generators\Traits\CrudField;
use Webfactor\Laravel\Generators\Traits\ValidationRule;

abstract class MigrationFieldAbstract implements MigrationFieldTypeInterface
{
    use CrudColumn, CrudField, ValidationRule;

    private $name;

    private $nullable;

    private $unique;

    public function __construct(array $fieldOptions, array $crudOptions = [])
    {
        $this->name = $fieldOptions['name'];

        $this->parseFieldOptions($fieldOptions['options']);
        $this->parseCrudOptions($crudOptions);
    }

    private function parseFieldOptions(string $option)
    {
        /*if ($option == 'nullable') {
            return $this->nullable = true;
        }

        if ($option == 'unique') {
            return $this->unique = true;
        }

        if (starts_with($option, 'default(')) {
            preg_match('/\((.*)\)/', $option, $match);

            return $this->default = $match[1];
        }*/
    }

    private function parseCrudOptions(array $crudOptions)
    {
        foreach ($crudOptions as $crudOption) {
            $this->parseCrudOption($crudOption);
        }
    }

    private function parseCrudOption(string $option)
    {
        preg_match('/^(field|column|rule)\((.*)\)/', $option, $match);

        if ($match[1] == 'rule') {
            $this->setValidationRule($match[2]);

            return;
        }

        if ($match[1] == 'field') {
            $this->setCrudFieldOptions($match[2]);

            return;
        }

        if ($match[1] == 'column') {
            $this->setCrudColumnOptions($match[2]);

            return;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isNullable()
    {
        return $this->nullable;
    }

    /**
     * @return bool
     */
    public function isUnique(): bool
    {
        return $this->unique;
    }
}
