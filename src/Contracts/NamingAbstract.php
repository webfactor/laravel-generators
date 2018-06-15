<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Illuminate\Console\DetectsApplicationNamespace;

abstract class NamingAbstract
{
    use DetectsApplicationNamespace;

    protected $path;

    protected $entity;

    public function __construct(string $entity)
    {
        $this->entity = $entity;
    }

    public function getFile(): string
    {
        return $this->getPath() . '/' . $this->getFileName();
    }

    abstract function getPath(): string;

    abstract function getFileName(): string;
}
