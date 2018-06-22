<?php

namespace Webfactor\Laravel\Generators\Services;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Traits\CanGenerateFile;

class BackpackCrudModelService extends ServiceAbstract implements ServiceInterface
{
    use CanGenerateFile;

    protected $key = 'crudModel';

    protected function buildFileContent()
    {
        $this->replaceClassNamespace();
        $this->replaceClassName();
        $this->replaceTableName();
        $this->replaceFillable();
    }

    protected function replaceFillable()
    {
        $fillables = $this->command->schema->getStructure()
            ->map(function ($item) {
                return "'" . $item->name . "'";
            });

        $this->fileContent = str_replace('__fillable__', $fillables->implode(', '), $this->fileContent);
    }
}
