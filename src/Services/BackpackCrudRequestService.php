<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;
use Webfactor\Laravel\Generators\Traits\CanGenerateFile;

class BackpackCrudRequestService extends ServiceAbstract implements ServiceInterface
{
    use CanGenerateFile;

    protected $key = 'crudRequest';

    public function getConsoleOutput() {
        return 'Generated request: '.$this->command->naming[$this->key]->getRelativeFilePath();
    }

    protected function buildFileContent()
    {
        $this->replaceClassNamespace();
        $this->replaceClassName();
        $this->replaceValidationRules();
    }

    protected function replaceValidationRules()
    {
        $this->fileContent = str_replace('__rules__', ShortSyntaxArray::parse($this->command->schema->getValidationRules()->toArray()), $this->fileContent);
    }

}
