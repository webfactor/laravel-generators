<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

use Illuminate\Console\DetectsApplicationNamespace;
use Webfactor\Laravel\Generators\Contracts\NamingAbstract;

class CrudModel extends NamingAbstract
{
    use DetectsApplicationNamespace;

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->getAppNamespace() . 'Models\\';
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return ucfirst($this->entity);
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
        return app_path('Models');
    }

    /**
     * @return string
     */
    public function getStub(): string
    {
        return __DIR__ . '/../../../stubs/crud-model.stub';
    }
}
