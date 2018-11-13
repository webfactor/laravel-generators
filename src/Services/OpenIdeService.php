<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class OpenIdeService extends ServiceAbstract implements ServiceInterface
{
    public function getConsoleOutput()
    {
        $ide = $this->getIde();

        return $ide ? 'Opening all generated or edited files in '.$ide : 'Editor not defined - not opening files in IDE';
    }

    public function call()
    {
        if ($this->getIde()) {
            return $this->openInIde();
        }
    }

    protected function getIde()
    {
        return $this->command->option('ide') ?? env('APP_EDITOR') ?? config('app.editor') ?? false;
    }

    protected function openInIde()
    {
        if ($ideClass = config('webfactor.generators.ides.' . $this->getIde())) {
            (new $ideClass($this->command->filesToBeOpened))->open();

            return;
        }

        $this->command->error('There is no opener class for ide <comment>' . $this->getIde() . '</comment>');
    }
}
