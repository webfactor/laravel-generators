<?php

namespace Webfactor\Laravel\Generators\Schemas;

use Illuminate\Support\Collection;
use Webfactor\Laravel\Generators\Contracts\FieldTypeInterface;

class MigrationSchema
{
    protected $structure;

    public function __construct(string $schema)
    {
        $this->structure = collect();

        foreach (explode(',', $schema) as $field) {
            $this->setMigrationField($field);
        }
    }

    private function setMigrationField($field)
    {
        $options = explode(':', $field);

        $name = array_shift($options);
        $type = array_shift($options);

        if ($fieldType = $this->getFieldType($type, $name, $options)) {
            $this->structure->push($fieldType);
        }
    }

    protected function getFieldType($type, $name, $options)
    {
        $typeClass = 'Webfactor\\Laravel\\Generators\\Schemas\\FieldTypes\\' . ucfirst($type) . 'Type';

        if (class_exists($typeClass)) {
            return $this->loadFieldType(new $typeClass($name, $options));
        }

        return null;
    }

    private function loadFieldType(FieldTypeInterface $fieldType)
    {
        return $fieldType;
    }

    /**
     * @return Collection
     */
    public function getStructure(): Collection
    {
        return $this->structure;
    }
}
