<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class OpenIdeService extends ServiceAbstract implements ServiceInterface
{
    public function call()
    {
        if (!$ide = $this->command->option('ide')) {
            return;
        }

        if ($ideClass = config('webfactor.generators.ides.' . $ide)) {
            (new $ideClass($this->command->filesToBeOpened))->open();
        }
    }
}
