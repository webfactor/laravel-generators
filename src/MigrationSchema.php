<?php

namespace Webfactor\Laravel\Generators;

class MigrationSchema
{
    protected $schema;

    public function __construct(string $schema)
    {
        $this->schema = collect();

        foreach (explode(',', $schema) as $field) {
            $this->schema->push(new MigrationField($field));
        }
    }
}
