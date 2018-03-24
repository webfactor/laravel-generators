<?php

namespace Webfactor\Laravel\Generators\Contracts;

abstract class MigrationFieldAbstract implements FieldTypeInterface
{
    private $name;

    private $nullable = false;

    private $unique = false;

    private $default = null;

    private $foreign = null;

    public function __construct(string $name, array $options = [])
    {
        $this->name = $name;

        foreach ($options as $option) {
            $this->fillObject($option);
        }
    }

    private function fillObject(string $param)
    {
        if ($param == 'nullable') {
            return $this->nullable = true;
        }

        if ($param == 'unique') {
            return $this->unique = true;
        }

        if ($param == 'foreign') {
            return $this->foreign = true;
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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
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

    abstract public function getRule(): string;

    abstract public function getColumn(): array;

    abstract public function getField(): array;
}
