<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

use Carbon\Carbon;
use Webfactor\Laravel\Generators\Contracts\NamingAbstract;

class Sidebar extends NamingAbstract
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
        return 'sidebar_content.blade.php';
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return resource_path('views/vendor/backpack/base/inc');
    }
}
