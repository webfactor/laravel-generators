<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class RouteService extends ServiceAbstract implements ServiceInterface
{
    protected $key = 'routeFile';

    public function call()
    {
        $routeFile = $this->naming->getFile();

        if ($this->filesystem->exists($routeFile)) {
            $this->filesystem->append($routeFile, $this->getRouteString());
            $this->addGeneratedFileToIdeStack();
        }
    }

    private function getRouteString()
    {
        return "\r\n" . 'CRUD::resource(\'' . $this->naming->getName() . '\', \'' . $this->command->naming['crudController']->getClassName() . '\');';
    }
}
