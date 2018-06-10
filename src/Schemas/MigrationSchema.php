<?php

namespace Webfactor\Laravel\Generators\Schemas;

use Illuminate\Support\Collection;
use Webfactor\Laravel\Generators\Contracts\MigrationFieldTypeInterface;

class MigrationSchema
{
    protected $structure = [];

    public function __construct(string $schema)
    {
        $this->extractMigrationFieldFromSchema(explode(',', $schema));
    }

    private function extractMigrationFieldFromSchema(array $schema)
    {
        foreach ($schema as $migrationFields) {
            $this->extractStructure(explode(';', $migrationFields));
        }
    }

    private function extractStructure(array $options)
    {

        $this->setMigrationField($this->getFieldOptions(array_shift($options)), $options);
    }

    private function getFieldOptions(string $fieldOptions): array
    {
        dd($this->getContentOfParenthesis($fieldOptions));
    }

    private function getContentOfParenthesis(string $string): string
    {
        $pattern = '/\(([^\(\)]*)\)/m';
        $pattern = '/([^\(\)]*)\(/m';

        preg_match_all($pattern, $string, $matches);

        return $matches[1][0] ?? '';
    }

    private function setMigrationField( $fieldOptions, array $crudOptions)
    {
        $name = array_shift($fieldOptions);
        $type = array_shift($fieldOptions);

        if ($migrationFieldType = $this->getMigrationFieldType($type, $name, compact('fieldOptions', 'crudOptions'))) {
            array_push($this->structure, $migrationFieldType);
        }
    }

    protected function getMigrationFieldType($type, $name, $options): ?MigrationFieldTypeInterface
    {
        $typeClass = '\\Webfactor\\Laravel\\Generators\\Schemas\\FieldTypes\\' . ucfirst($type) . 'Type';

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
