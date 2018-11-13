<?php

namespace Webfactor\Laravel\Generators\Services;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Traits\CanGenerateFile;

class MigrationService extends ServiceAbstract implements ServiceInterface
{
    use CanGenerateFile;

    protected $key = 'migration';

    public function getConsoleOutput() {
        return 'Generated migration file: '.$this->command->naming[$this->key]->getRelativeFilePath();
    }

    public function call()
    {
        $this->generateFile();
        $this->addGeneratedFileToIdeStack();

        if ($this->command->option('migrate')) {
            $this->command->call('migrate');
        }
    }

    protected function buildFileContent()
    {
        $this->replaceClassName();
        $this->replaceTableName();
        $this->replaceMigrationFields();
    }

    /**
     * Replace migration fields in stub file.
     *
     * @return string
     */
    protected function replaceMigrationFields(): void
    {
        $this->fileContent = str_replace('__migration_fields__', $this->generateMigrationFields(), $this->fileContent);
    }

    /**
     * Generates the migration fields from schema
     *
     * @return string
     */
    protected function generateMigrationFields(): string
    {
        $migrationFields = '';

        foreach ($this->command->schema->getMigrationFields() as $migrationField) {
            $migrationFields .= '$table->' . $migrationField['type'] . '(\'' . $migrationField['name'] . '\')';
            unset($migrationField['type'], $migrationField['name']);

            if (!empty($migrationField)) {
                foreach ($migrationField as $key => $item) {
                    $migrationFields .= '->' . $key . '(' . ((!is_bool($item)) ? '\'' . $item . '\'' : '') . ')';
                }
            }

            $migrationFields .= ";" . PHP_EOL;
        }

        return $migrationFields;
    }
}
