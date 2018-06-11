<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Webfactor\Laravel\Generators\Helper\RegexParser;
use Webfactor\Laravel\Generators\Traits\CrudColumn;
use Webfactor\Laravel\Generators\Traits\CrudField;
use Webfactor\Laravel\Generators\Traits\ValidationRule;

abstract class MigrationFieldAbstract implements MigrationFieldTypeInterface
{
    use CrudColumn, CrudField, ValidationRule;

    private $name;

    private $availableMethods = [
        'field' => 'setCrudFieldOptions',
        'column' => 'setCrudColumnOptions',
        'rule' => 'setValidationRule',
    ];

    public function __construct(array $fieldOptions, array $crudOptions = [])
    {
        $this->name = $this->crudField['name'] = $this->crudColumn['name'] = $fieldOptions['name'];

        //$this->parseFieldOptions($fieldOptions['options']);
        $this->parseCrudOptions($crudOptions);
    }

    private function parseFieldOptions(string $fieldOptions)
    {
        // TODO: define options
    }

    private function parseCrudOptions(array $crudOptions)
    {
        foreach ($crudOptions as $crudOption) {
            $this->parseCrudOption($crudOption);
        }
    }

    private function parseCrudOption(string $crudOption)
    {
        ['left' => $left, 'inside' => $inside] = RegexParser::parseParenthesis($crudOption);

        if (key_exists($left, $this->availableMethods)) {
            call_user_func([$this, $this->availableMethods[$left]], $inside);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
