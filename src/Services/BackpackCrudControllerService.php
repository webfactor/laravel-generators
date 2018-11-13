<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\SchemaFieldAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;
use Webfactor\Laravel\Generators\Traits\CanGenerateFile;

class BackpackCrudControllerService extends ServiceAbstract implements ServiceInterface
{
    use CanGenerateFile;

    protected $key = 'crudController';

    public function getConsoleOutput() {
        return 'Generated controller: '.$this->command->naming[$this->key]->getRelativeFilePath();
    }

    protected function buildFileContent()
    {
        $this->replaceClassNamespace();
        $this->replaceClassName();
        $this->replaceModelRelatedStrings();
        $this->replaceRequestRelatedStrings();
        $this->replaceLanguageFileRelatedStrings();
        $this->replaceRouteFileRelatedStrings();
        $this->replaceFieldStrings();
        $this->replaceColumnStrings();
    }

    protected function replaceModelRelatedStrings()
    {
        $this->fileContent = str_replace('__model_namespace__', $this->command->naming['crudModel']->getNamespace(), $this->fileContent);
        $this->fileContent = str_replace('__model_class__', $this->command->naming['crudModel']->getClassName(), $this->fileContent);
    }

    protected function replaceRequestRelatedStrings()
    {
        $this->fileContent = str_replace('__request_namespace__', $this->command->naming['crudRequest']->getNamespace(), $this->fileContent);
        $this->fileContent = str_replace('__request_class__', $this->command->naming['crudRequest']->getClassName(), $this->fileContent);
    }

    protected function replaceLanguageFileRelatedStrings()
    {
        $this->fileContent = str_replace('__languagefile_key__', $this->command->naming['languageFile']->getName(), $this->fileContent);
    }

    protected function replaceRouteFileRelatedStrings()
    {
        $this->fileContent = str_replace('__route_name__', $this->command->naming['routeFile']->getName(), $this->fileContent);
    }

    protected function replaceFieldStrings()
    {
        $this->fileContent = str_replace('__fields__', ShortSyntaxArray::parse($this->command->schema->getCrudFields()->toArray()), $this->fileContent);
    }

    protected function replaceColumnStrings()
    {
        $this->fileContent = str_replace('__columns__', ShortSyntaxArray::parse($this->command->schema->getCrudColumns()->toArray()), $this->fileContent);
    }
}
