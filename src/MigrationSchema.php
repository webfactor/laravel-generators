<?php

namespace Webfactor\Laravel\Generators;

class MigrationSchema
{
    protected $schema;

    protected $original;

    public function __construct(string $schema)
    {
        $this->original = $schema;
        $this->schema = collect();

        $this->parse();
    }

    private function parse()
    {
        foreach ($this->parseSchemaString($this->original) as $field) {
            $this->schema->push($this->parseField($field));
        }
    }

    private function parseSchemaString(string $schema)
    {
        return explode(',', $schema);
    }

    private function parseField(string $field)
    {
        return new MigrationField($field);
    }
}
