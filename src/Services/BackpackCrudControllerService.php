<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;
use Webfactor\Laravel\Generators\Schemas\CrudColumn;
use Webfactor\Laravel\Generators\Schemas\CrudField;

class BackpackCrudControllerService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'app/Http/Controllers/Admin';

    protected $columns = [];

    protected $fields = [];

    public function call()
    {
        $this->command->call('make:crud-controller', [
            'name' => $this->getName($this->command->entity),
        ]);

        $this->addLatestFileToIdeStack();

        $this->setColumnsFromSchema();
        $this->setFieldsFromSchema();

        $this->fillColumnsAndFieldsInGeneratedControllerFromSchema();
    }

    public function getName(string $entity): string
    {
        return ucfirst($entity);
    }

    private function fillColumnsAndFieldsInGeneratedControllerFromSchema(): void
    {
        $controllerFile = end($this->command->filesToBeOpened);

        $controller = $this->filesystem->get($controllerFile);
        $controller = str_replace('__columns__', $this->getColumnsAsString(), $controller);
        $controller = str_replace('__fields__', $this->getfieldsAsString(), $controller);
        $this->filesystem->put($controllerFile, $controller);
    }

    private function setColumnsFromSchema(): void
    {
        $this->command->schema->getStructure()->each(function ($field) {
            array_push($this->columns, new CrudColumn($field));
        });
    }

    private function setFieldsFromSchema(): void
    {
        $this->command->schema->getStructure()->each(function ($field) {
            array_push($this->fields, new CrudField($field));
        });
    }

    /**
     * @return string
     */
    private function getColumnsAsString(): string
    {
        $columnsArray = [];

        foreach ($this->columns as $crudColumn) {
            if ($column = $crudColumn->generateColumn()) {
                array_push($columnsArray, $column);
            }
        }

        return ShortSyntaxArray::parse($columnsArray);
    }

    /**
     * @return string
     */
    private function getfieldsAsString(): string
    {
        $fieldsArray = [];

        foreach ($this->fields as $crudfield) {
            if ($field = $crudfield->generateField()) {
                array_push($fieldsArray, $field);
            }
        }

        return ShortSyntaxArray::parse($fieldsArray);
    }
}
