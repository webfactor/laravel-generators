<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Traits\CanGenerateFile;

class SeederService extends ServiceAbstract implements ServiceInterface
{
    use CanGenerateFile;

    protected $key = 'seeder';

    public function getConsoleOutput()
    {
        return 'Generated seeder: '.$this->command->naming[$this->key]->getRelativeFilePath();
    }

    protected function buildFileContent()
    {
        $this->replaceClassName();
        $this->replaceModelRelatedStrings();
    }

    protected function replaceModelRelatedStrings()
    {
        $this->fileContent = str_replace('__model_namespace__', $this->command->naming['crudModel']->getNamespace(), $this->fileContent);
        $this->fileContent = str_replace('__model_class__', $this->command->naming['crudModel']->getClassName(), $this->fileContent);
    }
}
