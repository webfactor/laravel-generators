<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;

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
        $this->fillColumnsAndFieldsInGeneratedControllerFromSchema();
    }

    public function getName(string $entity): string
    {
        return ucfirst($entity);
    }

    private function fillColumnsAndFieldsInGeneratedControllerFromSchema()
    {
        $controllerFile = end($this->command->filesToBeOpened);

        $controller = $this->filesystem->get($controllerFile);
        $controller = str_replace('__columns__', $this->getColumnsFromSchema(), $controller);
        $controller = str_replace('__fields__', $this->getFieldsFromSchema(), $controller);
        $this->filesystem->put($controllerFile, $controller);
    }

    /**
     * @return string
     */
    private function getColumnsFromSchema()
    {
        $this->command->schema->getStructure()->each(function ($field) {
            array_push($this->columns, $field->makeColumn());
        });

        return ShortSyntaxArray::parse($this->columns);
    }

    /**
     * @return string
     */
    private function getFieldsFromSchema()
    {
        $this->command->schema->getStructure()->each(function ($field) {
            array_push($this->fields, $field->makeField());
        });

        return ShortSyntaxArray::parse($this->fields);
    }
}
