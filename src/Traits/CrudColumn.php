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
        $this->setOptions('crudColumn', $crudColumnOptions);
    }
}
