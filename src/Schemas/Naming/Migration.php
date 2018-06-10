<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

class Migration
{
    public $key = 'migration';

    private $directory = 'database/migrations/';

    private $className;

    private $tableName;

    private $fileName;

    public function __construct(string $entity)
    {
        $this->setClassName($entity);
        $this->setTableName($entity);
        $this->setFileName();
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
        $this->className = 'Create' . ucfirst(str_plural($entity)) . 'Table';
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $entity
     */
    public function setTableName(string $entity): void
    {
        $this->tableName = snake_case(str_plural($entity));
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
        $this->fileName = snake_case($this->getClassName());
    }
}
