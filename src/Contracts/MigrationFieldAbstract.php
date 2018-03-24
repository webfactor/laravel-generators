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

        foreach ($options as $option) {
            $this->parseOptions($option);
        }
    }

    private function parseOptions(string $param)
    {
        if ($param == 'nullable') {
            return $this->nullable = true;
        }

        if ($param == 'unique') {
            return $this->unique = true;
        }

        if (starts_with($param, 'default(')) {
            preg_match('/\((.*)\)/', $param, $match);

            return $this->default = $match[1];
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
