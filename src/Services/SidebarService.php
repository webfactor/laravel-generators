<?php

namespace Webfactor\Laravel\Generators\Services;

use Illuminate\Filesystem\Filesystem;
use Webfactor\Laravel\Generators\Commands\MakeEntity;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class SidebarService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'resources/views/vendor/backpack/base/inc';

    protected $fileName = 'sidebar_content.blade.php';

    private $sidebarFile;

    public function call()
    {
        $this->sidebarFile = $this->getFilePath();

        if ($this->filesystem->exists($this->sidebarFile)) {
            $this->writeFile();
            $this->addLatestFileToIdeStack();
        }
    }

    private function getRouteName(): string
    {
        return strtolower($this->command->entity);
    }

    private function getLanguageName(): string
    {
        return snake_case($this->command->entity);
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
        $this->filesystem->append($this->sidebarFile, $this->getRouteString());
    }

    private function getFilePath()
    {
        return base_path($this->relativeToBasePath) . '/' . $this->fileName;
    }

    private function getRouteString()
    {
        return <<<FILE

<li>
    <a href="{{ backpack_url('{$this->getRouteName()}') }}">
        <i class="fa fa-question"></i><span>{{ trans('models.{$this->getLanguageName()}.plural') }}</span>
    </a>
</li>
FILE;
    }
}
