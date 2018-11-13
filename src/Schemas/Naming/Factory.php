<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

use Webfactor\Laravel\Generators\Contracts\NamingAbstract;

class Factory extends NamingAbstract
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return ucfirst($this->entity) . 'Factory';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->getName() . '.php';
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return database_path('factories');
    }

    /**
     * @return string
     */
    public function getRelativeFilePath(): string
    {
        return 'database/factories/'.$this->getFileName();
    }

    /**
     * @return string
     */
    public function getStub(): string
    {
        return __DIR__ . '/../../../stubs/factory.stub';
    }
}
