<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\MigrationFieldAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;

class BackpackCrudControllerService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'app/Http/Controllers/Admin';

    private $columns = [];

    private $fields = [];

    public function call()
    {
        $this->command->call('make:crud-controller', [
            'name' => $this->getName($this->command->entity),
        ]);

        $this->addLatestFileToIdeStack();

        $this->setColumns();
        $this->setFields();

        $this->insertColumnsAndFieldsInGeneratedController();
    }

    public function getName(string $entity): string
    {
        return ucfirst($entity);
    }

    private function setFields(): void
    {
        $this->command->schema->getStructure()->each(function (MigrationFieldAbstract $migrationField) {
            array_push($this->fields, $migrationField->getCrudField());
        });
    }

    private function setColumns(): void
    {
        $this->command->schema->getStructure()->each(function (MigrationFieldAbstract $migrationField) {
            array_push($this->columns, $migrationField->getCrudColumn());
        });
    }

    private function insertColumnsAndFieldsInGeneratedController(): void
    {
        $controllerFile = end($this->command->filesToBeOpened);

        $controller = $this->filesystem->get($controllerFile);
        $controller = str_replace('__columns__', $this->getColumnsAsString(), $controller);
        $controller = str_replace('__fields__', $this->getfieldsAsString(), $controller);
        $this->filesystem->put($controllerFile, $controller);
    }

    /**
     * @return string
     */
    private function getColumnsAsString(): string
    {
        return ShortSyntaxArray::parse($this->columns);
    }

    /**
     * @return string
     */
    private function getFieldsAsString(): string
    {
        return ShortSyntaxArray::parse($this->fields);
    }
}
