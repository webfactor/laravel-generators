<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class SidebarService extends ServiceAbstract implements ServiceInterface
{
    protected $key = 'sidebar';

    public function getConsoleOutput() {
        return 'Added sidebar item to '.$this->command->naming[$this->key]->getRelativeFilePath();
    }

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
