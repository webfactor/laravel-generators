<?php

namespace Webfactor\Laravel\Generators\Schemas;

class CrudField
{
    private $type;

    private $field;

    public function __construct(MigrationField $migrationField)
    {
        $this->type = $migrationField->getType();
        $this->field = $migrationField->getName();
    }

    public function generateField(): array
    {
        return [
            'name'  => $this->getField(),
            'type'  => $this->getType(),
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
