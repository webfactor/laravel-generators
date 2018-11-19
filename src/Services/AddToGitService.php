<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class AddToGitService extends ServiceAbstract implements ServiceInterface
{
    public function getConsoleOutput()
    {
        return $this->shouldPerformService() ? 'Changes added to git' : 'Changes were not added to git';
    }

    public function shouldPerformService()
    {
        return $this->command->option('git');
    }

    public function call()
    {
        if ($this->shouldPerformService()) {
            foreach ($this->command->filesToBeOpened as $file) {
                exec('git add '.$file->getPathname());
            }
        }
    }
}
