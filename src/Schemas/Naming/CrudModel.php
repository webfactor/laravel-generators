<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

class CrudModel
{
    private $namespace = 'App\\Models';

    private $directory = 'app/models/';

    private $className;

    private $fileName;

    public function __construct(string $entity)
    {
        $this->setClassName($entity);
        $this->setFileName();
    }

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param string $entity
     */
    public function setClassName(string $entity): void
    {
        $this->className = ucfirst($entity);
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName(): void
    {
        $this->fileName = $this->getClassName() . '.php';
    }

    /**
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }
}