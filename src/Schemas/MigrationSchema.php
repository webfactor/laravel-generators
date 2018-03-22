<?php

namespace Webfactor\Laravel\Generators\Schemas;

use Illuminate\Support\Collection;

class MigrationSchema
{
    protected $structure;

    public function __construct(string $schema)
    {
        $this->structure = collect();

        foreach (explode(',', $schema) as $field) {
            $this->structure->push(new MigrationField($field));
        }
    }

    /**
     * @return Collection
     */
    public function getStructure(): Collection
    {
        return $this->structure;
    }
}
