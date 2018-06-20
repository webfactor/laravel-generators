<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Illuminate\Console\DetectsApplicationNamespace;

abstract class NamingAbstract
{
    use DetectsApplicationNamespace;

    protected $path;

    protected $entity;

    /**
     * NamingAbstract constructor.
     * @param string $entity
     */
    public function __construct(string $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->getPath() . '/' . $this->getFileName();
    }

    /**
     * @return string
     */
    abstract function getPath(): string;

    abstract function getFileName(): string;
}
