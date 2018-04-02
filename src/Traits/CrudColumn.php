<?php

namespace Webfactor\Laravel\Generators\Traits;

trait CrudColumn
{
    private $column = [];

    protected $crudColumnType;

    protected $crudColumnOptions = [];

    public function getCrudColumn(): array
    {
        $this->column['name'] = $this->name;
        $this->column['label'] = $this->name;
        $this->column['type'] = $this->crudColumnType;

        if ($this->crudColumnOptions) {
            $this->addCrudColumnOptions();
        }

        return $this->column;
    }

    private function addCrudColumnOptions()
    {
        foreach ($this->crudColumnOptions as $key => $option) {
            $this->column[$key] = $option;
        }
    }

    private function setCrudColumnOptions(string $crudColumnOptions)
    {
        $crudColumnOptions = explode(':', $crudColumnOptions);

        $this->crudColumnType = array_shift($crudColumnOptions);
    }
}
