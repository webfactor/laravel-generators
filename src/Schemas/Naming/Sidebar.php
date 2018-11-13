<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

use Webfactor\Laravel\Generators\Contracts\NamingAbstract;

class Sidebar extends NamingAbstract
{
    private $path = 'views/vendor/backpack/base/inc';

    /**
     * @return string
     */
    public function getName(): string
    {
        return snake_case($this->entity);
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return 'sidebar_content.blade.php';
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return resource_path($this->path);
    }

    /**
     * @return string
     */
    public function getRelativeFilePath(): string
    {
        return 'resources/'.$this->path.'/'.$this->getFileName();
    }
}
