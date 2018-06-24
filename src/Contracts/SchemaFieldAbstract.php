<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Webfactor\Laravel\Generators\Helper\RegexParser;
use Webfactor\Laravel\Generators\Traits\CrudColumn;
use Webfactor\Laravel\Generators\Traits\CrudField;
use Webfactor\Laravel\Generators\Traits\MigrationField;
use Webfactor\Laravel\Generators\Traits\ValidationRule;

abstract class SchemaFieldAbstract implements SchemaFieldTypeInterface
{
    use MigrationField, CrudColumn, CrudField, ValidationRule;

    public $name;

    private $availableMethods = [
        'field' => 'setCrudFieldOptions',
        'column' => 'setCrudColumnOptions',
        'rule' => 'setValidationRule',
    ];

    public function __construct(array $fieldOptions, array $crudOptions = [])
    {
        $this->name = $this->crudField['name'] = $this->crudColumn['name'] = $fieldOptions['name'];

        $this->setMigrationField($fieldOptions['options']);
        $this->parseCrudOptions($crudOptions);
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
     * @param string $variableName
     * @param string $options
     */
    private function setOptions(string $variableName, string $options): void
    {
        $this->{$variableName}['name'] = $this->name;

        if ($options) {
            foreach (explode('|', $options) as $option) {
                if (str_contains($option, ':')) {
                    $option = explode(':', $option);
                    $this->{$variableName}[$option[0]] = $option[1];
                } else {
                    $this->{$variableName}[$option] = true;
                }
            }
        }
    }
}
