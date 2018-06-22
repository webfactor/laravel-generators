<?php

namespace Webfactor\Laravel\Generators\Schemas;

use Illuminate\Support\Collection;
use Webfactor\Laravel\Generators\Contracts\SchemaFieldTypeInterface;
use Webfactor\Laravel\Generators\Helper\RegexParser;

class Schema
{
    protected $structure = [];

    public function __construct(string $schema)
    {
        $this->parseSchemaFields($this->getSchemaFieldsFromSchemaString($schema));
    }

    /**
     * @return Collection
     */
    public function getStructure(): Collection
    {
        return collect($this->structure);
    }

    private function getSchemaFieldsFromSchemaString(string $schema): array
    {
        return explode(',', $schema);
    }

    private function parseSchemaFields(array $schemaFields): void
    {
        foreach ($schemaFields as $schemaField) {
            $this->parseSchemaField($schemaField);
        }
    }

    private function parseSchemaField(string $schemaField): void
    {
        $schemaFieldParts = explode(';', $schemaField);

        $this->setSchemaField($this->parseMigration(array_shift($schemaFieldParts)), $schemaFieldParts);
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

    private function setSchemaField(array $migrationOptions, array $crudOptions): void
    {
        if ($schemaFieldType = $this->getSchemaFieldType($migrationOptions, $crudOptions)) {
            array_push($this->structure, $schemaFieldType);
        }
    }

    protected function getSchemaFieldType(array $migrationOptions, array $crudOptions): ?SchemaFieldTypeInterface
    {
        $typeClass = config('webfactor.generators.fieldTypes.'. $migrationOptions['type']);

        if (class_exists($typeClass)) {
            return $this->loadMigrationFieldType(new $typeClass($migrationOptions, $crudOptions));
        }

        return null;
    }

    private function loadMigrationFieldType(SchemaFieldTypeInterface $fieldType): SchemaFieldTypeInterface
    {
        return $fieldType;
    }
}
