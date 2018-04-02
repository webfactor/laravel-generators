<?php

namespace Webfactor\Laravel\Generators\Schemas;

use Illuminate\Support\Collection;
use Webfactor\Laravel\Generators\Contracts\MigrationFieldTypeInterface;

class MigrationSchema
{
    protected $structure = [];

    public function __construct(string $schema)
    {
        $this->extractPartsFromSchema(explode(',', $schema));
    }

    private function extractPartsFromSchema(array $schema)
    {
        foreach ($schema as $parts) {
            $this->extractStructure(explode(';', $parts));
        }
    }

    private function extractStructure(array $options)
    {
        $this->setMigrationField(explode(':', array_shift($options)), $options);
    }

    private function setMigrationField(array $fieldOptions, array $crudOptions)
    {
        $name = array_shift($fieldOptions);
        $type = array_shift($fieldOptions);

        if ($migrationFieldType = $this->getMigrationFieldType($type, $name, compact('fieldOptions', 'crudOptions'))) {
            array_push($this->structure, $migrationFieldType);
        }
    }

    protected function getMigrationFieldType($type, $name, $options): ?MigrationFieldTypeInterface
    {
        $typeClass = 'Webfactor\\Laravel\\Generators\\Schemas\\FieldTypes\\' . ucfirst($type) . 'Type';

        if (class_exists($typeClass)) {
            return $this->loadMigrationFieldType(new $typeClass($name, $options));
        }

        return null;
    }

    private function loadMigrationFieldType(MigrationFieldTypeInterface $fieldType): MigrationFieldTypeInterface
    {
        return $fieldType;
    }

    /**
     * @return Collection
     */
    public function getStructure(): Collection
    {
        return collect($this->structure);
    }
}
