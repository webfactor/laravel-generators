<?php

namespace Webfactor\Laravel\Generators\Services;

use Illuminate\Filesystem\Filesystem;
use Webfactor\Laravel\Generators\Commands\MakeEntity;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class RouteService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'routes/backpack';

    protected $fileName = 'custom.php';

    private $routeFile;

    public function call()
    {
        $this->routeFile = $this->getFilePath();

        if ($this->filesystem->exists($this->routeFile)) {
            $this->writeFile();
            $this->addGeneratedFileToIdeStack();
        }
    }

    private function getRouteName(): string
    {
        return strtolower($this->command->entity);
    }

    private function getControllerName(): string
    {
        return ucfirst($this->command->entity) . 'CrudController';
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     */
    private function writeFile()
    {
        $this->filesystem->append($this->routeFile, $this->getRouteString());
    }

    private function getFilePath()
    {
        return base_path($this->relativeToBasePath) . '/' . $this->fileName;
    }

    private function getRouteString()
    {
        return "\r\n" . 'CRUD::resource(\'' . $this->getRouteName() . '\', \'' . $this->getControllerName() . '\');';
    }
}
