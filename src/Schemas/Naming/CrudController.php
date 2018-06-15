<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

use Webfactor\Laravel\Generators\Contracts\NamingAbstract;

class CrudController extends NamingAbstract
{
    /**
     * Relative path to app
     * @var string
     */
    protected $path = 'Http/Controllers/Admin';

    protected $namespace = 'Http\\Controllers\\Admin\\';

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->getAppNamespace() . $this->namespace;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return ucfirst($this->entity) . 'CrudController';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->getClassName() . '.php';
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return app_path($this->path);
    }
}
