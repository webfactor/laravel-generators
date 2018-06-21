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
     * Generate migration fields in stub file.
     *
     * @return string
     */
    protected function replaceMigrationFields(): void
    {
        $this->fileContent = str_replace('__migration_fields__', $this->generateMigrationFields(), $this->fileContent);
    }

    protected function generateMigrationFields(): string
    {
        return '';
    }
}
