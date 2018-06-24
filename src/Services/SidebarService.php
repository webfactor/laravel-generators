<?php

namespace Webfactor\Laravel\Generators\Services;

use Illuminate\Filesystem\Filesystem;
use Webfactor\Laravel\Generators\Commands\MakeEntity;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class SidebarService extends ServiceAbstract implements ServiceInterface
{
    protected $key = 'sidebar';

    public function call()
    {
        $sidebarFile = $this->naming->getFile();

        if ($this->filesystem->exists($sidebarFile)) {
            $this->filesystem->append($sidebarFile, $this->getSidebarString());
            $this->addGeneratedFileToIdeStack();
        }
    }

    private function getSidebarString()
    {
        return <<<FILE

<li>
    <a href="{{ backpack_url('{$this->command->naming['routeFile']->getName()}') }}">
        <i class="fa fa-question"></i><span>{{ trans('models.{$this->command->naming['languageFile']->getName()}.plural') }}</span>
    </a>
</li>
FILE;
    }
}
