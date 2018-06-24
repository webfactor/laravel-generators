<?php

namespace Webfactor\Laravel\Generators\Traits;

trait MigrationField
{
    public $migrationField = [
        'type' => 'string',
    ];

    public function getMigrationField(): array
    {
        return $this->migrationField;
    }

    private function setMigrationField(string $migrationFieldOptions)
    {
        $this->setOptions('migrationField', $migrationFieldOptions);
    }
}
