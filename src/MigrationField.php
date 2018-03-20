<?php

namespace Webfactor\Laravel\Generators;

class MigrationField
{
    protected $name;

    protected $type;

    protected $nullable = false;

    protected $unique = false;

    protected $default = null;

    protected $foreign = null;

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
}
