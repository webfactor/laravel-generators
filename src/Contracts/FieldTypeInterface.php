<?php

namespace Webfactor\Laravel\Generators\Contracts;

interface FieldTypeInterface
{
    public function getRule(): string;

    public function getColumn(): array;

    public function getField(): array;
}
