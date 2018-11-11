<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class OpenIdeService extends ServiceAbstract implements ServiceInterface
{
    public function call()
    {
        if ($ide = $this->command->option('ide')) {
            return $this->openInIde($ide);
        }

        if ($ide = env('APP_EDITOR')) {
            return $this->openInIde($ide);
        }

        if ($ide = config('app.editor')) {
            return $this->openInIde($ide);
        }
    }

    protected function openInIde($ide)
    {
        if ($ideClass = config('webfactor.generators.ides.' . $ide)) {
            (new $ideClass($this->command->filesToBeOpened))->open();

            return;
        }

        $this->command->error('There is no opener class for ide <comment>' . $ide . '</comment>');
    }
}
