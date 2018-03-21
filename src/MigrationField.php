<?php

namespace Webfactor\Laravel\Generators;

class MigrationField
{
    private $name;

    private $type;

    private $nullable = false;

    private $unique = false;

    private $default = null;

    private $foreign = null;

    public function __construct(string $field)
    {
        $this->parse($field);
    }

    private function parse(string $field)
    {
        $params = collect(explode(':', $field));

        $this->name = $params->pull(0);
        $this->type = $params->pull(1);

        foreach ($params as $param) {
            $this->fillObject($param);
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
}
