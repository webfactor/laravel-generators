<?php

namespace Webfactor\Laravel\Generators\Schemas;

class CrudColumn
{
    private $type;

    private $field;

    public function __construct(MigrationField $migrationField)
    {
        $this->type = $migrationField->getType();
        $this->field = $migrationField->getField();
    }

    public function generateColumn(): array
    {
        return [
            'name' => $this->getField(),
            'type' => $this->getType(),
        ];
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
}
