<?php

namespace Webfactor\Laravel\Generators\Traits;

trait CrudColumn
{
    public $crudColumn = [
        'type' => 'text',
    ];

    public function getCrudColumn(): array
    {
        return $this->crudColumn;
    }

    private function setCrudColumnOptions(string $crudColumnOptions)
    {
        $this->crudColumn['name'] = $this->name;

        foreach (explode('|', $crudColumnOptions) as $crudColumnOption) {
            $option = explode(':', $crudColumnOption);
            $this->crudColumn[$option[0]] = $option[1];
        }
    }
}
