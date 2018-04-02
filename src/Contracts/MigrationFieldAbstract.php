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

    public function __construct(string $name, array $options = [])
    {
        $this->name = $name;

        $this->parseOptions([$this, 'parseFieldOption'], data_get($options, 'fieldOptions', []));
        $this->parseOptions([$this, 'parseCrudOption'], data_get($options, 'crudOptions', []));
    }

    private function parseOptions(callable $method, array $options)
    {
        foreach ($options as $option) {
            call_user_func($method, $option);
        }
    }

    private function parseFieldOption(string $option)
    {
        if ($option == 'nullable') {
            return $this->nullable = true;
        }

        if ($option == 'unique') {
            return $this->unique = true;
        }

        if (starts_with($option, 'default(')) {
            preg_match('/\((.*)\)/', $option, $match);

            return $this->default = $match[1];
        }
    }

    private function parseCrudOption(string $option)
    {
        preg_match('/^(field|column|rule):(.*)/', $option, $match);

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
