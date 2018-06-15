<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

use Webfactor\Laravel\Generators\Contracts\NamingAbstract;

class Migration extends NamingAbstract
{
    /**
     * Relative path to database
     * @var string
     */
    protected $path = 'migrations';

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return 'Create' . ucfirst(str_plural($this->entity)) . 'Table';
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return snake_case(str_plural($this->entity));
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return snake_case($this->getClassName());
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return database_path($this->path);
    }
}
