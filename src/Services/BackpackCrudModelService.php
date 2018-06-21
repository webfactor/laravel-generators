<?php

namespace Webfactor\Laravel\Generators\Services;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class BackpackCrudModelService extends ServiceAbstract implements ServiceInterface
{
    protected $key = 'crudModel';

    public function call()
    {
        $this->generateMigrationFile();
        $this->addGeneratedFileToIdeStack();
    }

    /**
     * Generate the crud model and save it according to specified naming.
     *
     * @return void
     */
    protected function generateMigrationFile(): void
    {
        try {
            $stub = $this->filesystem->get($this->naming->getStub());
        } catch (FileNotFoundException $exception) {
            $this->command->error('Could not find stub file: ' . $this->naming->getStub());
        }

        $this->replaceClassName($stub);
        $this->replaceTableName($stub);
        $this->replaceMigrationFields($stub);

        $this->filesystem->put($this->naming->getFile(), $stub);
    }

    /**
     * Replace the class name in stub file.
     *
     * @return string
     */
    protected function replaceClassName(&$stub): void
    {
        $stub = str_replace('__migration_class__', $this->naming->getClassName(), $stub);
    }

    /**
     * Replace the table name in stub file.
     *
     * @return string
     */
    protected function replaceTableName(&$stub): void
    {
        $stub = str_replace('__table_name__', $this->naming->getTableName(), $stub);
    }

    /**
     * Generate migration fields in stub file.
     *
     * @return string
     */
    protected function replaceMigrationFields(&$stub): void
    {
        $stub = str_replace('__migration_fields__', $this->generateMigrationFields(), $stub);
    }

    protected function generateMigrationFields(): string
    {
        return '';
    }
}
