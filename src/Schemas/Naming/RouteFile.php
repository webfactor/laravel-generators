<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

use Webfactor\Laravel\Generators\Contracts\NamingAbstract;

class RouteFile extends NamingAbstract
{
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
        return 'custom.php';
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return base_path('routes/backpack');
    }
}
