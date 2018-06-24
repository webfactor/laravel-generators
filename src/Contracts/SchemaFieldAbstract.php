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

    /**
     * The name of the entity
     *
     * @var string
     */
    public $name;

    /**
     * Keywords that can be used in schema string
     *
     * @var array
     */
    private $availableMethods = [
        'field' => 'setCrudFieldOptions',
        'column' => 'setCrudColumnOptions',
        'rule' => 'setValidationRule',
    ];

    /**
     * SchemaFieldAbstract constructor.
     *
     * @param array $fieldOptions
     * @param array $crudOptions
     */
    public function __construct(array $fieldOptions, array $crudOptions = [])
    {
        $this->name = $this->crudField['name'] = $this->crudColumn['name'] = $fieldOptions['name'];

        $this->setMigrationField($fieldOptions['options']);
        $this->parseCrudOptions($crudOptions);
    }

    /**
     * Go through any additionally provided CRUD (field, column or rule
     *
     * @param array $crudOptions
     */
    private function parseCrudOptions(array $crudOptions): void
    {
        foreach ($crudOptions as $crudOption) {
            $this->parseCrudOption($crudOption);
        }
    }

    /**
     * Parse the given string and call the corresponding method if exists
     *
     * @param string $crudOption
     */
    private function parseCrudOption(string $crudOption)
    {
        ['left' => $left, 'inside' => $inside] = RegexParser::parseParenthesis($crudOption);

        if (key_exists($left, $this->availableMethods)) {
            call_user_func([$this, $this->availableMethods[$left]], $inside);
        }
    }

    /**
     * Set options coming from inside the parenthesises
     *
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
