<?php

namespace Webfactor\Laravel\Generators\Schemas;

use Illuminate\Support\Collection;
use Webfactor\Laravel\Generators\Contracts\MigrationFieldTypeInterface;
use Webfactor\Laravel\Generators\Helper\RegexParser;

class MigrationSchema
{
    protected $structure = [];

    public function __construct(string $schema)
    {
        $this->parseMigrationFields($this->getMigrationFieldsFromSchema($schema));
    }

    /**
     * @return Collection
     */
    public function getStructure(): Collection
    {
        return collect($this->structure);
    }

    private function getMigrationFieldsFromSchema(string $schema): array
    {
        return explode(',', $schema);
    }

    private function parseMigrationFields(array $migrationFields): void
    {
        foreach ($migrationFields as $migrationField) {
            $this->parseMigrationField($migrationField);
        }
    }

    private function parseMigrationField(string $migrationField): void
    {
        $crudOptions = explode(';', $migrationField);

        $this->setMigrationField($this->parseMigration(array_shift($crudOptions)), $crudOptions);
    }

    private function parseMigration(string $migrationString): array
    {
        ['left' => $left, 'inside' => $inside] = RegexParser::parseParenthesis($migrationString);
        [$name, $type] = explode(':', $left);

        return [
            'name' => $name,
            'type' => $type,
            'options' => $inside,
        ];
    }

    private function setMigrationField(array $fieldOptions, array $crudOptions): void
    {
        if ($migrationFieldType = $this->getMigrationFieldType($fieldOptions, $crudOptions)) {
            array_push($this->structure, $migrationFieldType);
        }
    }

    protected function getMigrationFieldType(array $fieldOptions, array $crudOptions): ?MigrationFieldTypeInterface
    {
        $typeClass = config('webfactor.generators.fieldTypes.'.$fieldOptions['type']);

        if (class_exists($typeClass)) {
            return $this->loadMigrationFieldType(new $typeClass($fieldOptions, $crudOptions));
        }

        return null;
    }

    private function loadMigrationFieldType(MigrationFieldTypeInterface $fieldType): MigrationFieldTypeInterface
    {
        return $fieldType;
    }
}
