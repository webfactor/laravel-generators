<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class AddToGitService extends ServiceAbstract implements ServiceInterface
{
    public function call()
    {
        if ($this->command->option('git')) {
            foreach ($this->command->filesToBeOpened as $file) {
                exec('git add '.$file->getPathname());
            }
        }
    }
}
