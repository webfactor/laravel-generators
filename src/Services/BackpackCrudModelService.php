<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class BackpackCrudModelService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'app/Models';

    private $fillable;

    public function call()
    {
        $this->command->call('make:crud-model', [
            'name' => $this->getName($this->command->entity),
        ]);

        $this->addLatestFileToIdeStack();
        $this->fillFillableAttributeInGeneratedModelFromSchema();
    }

    /**
     * @param string $entity
     *
     * @return string
     */
    public function getName(string $entity): string
    {
        return ucfirst($entity);
    }

    private function fillFillableAttributeInGeneratedModelFromSchema()
    {
        $modelFile = end($this->command->filesToBeOpened);

        $model = $this->filesystem->get($modelFile);
        $model = str_replace('__fillable__', $this->getFillableFromSchema(), $model);
        $this->filesystem->put($modelFile, $model);
    }

    /**
     * @return string
     */
    private function getFillableFromSchema()
    {
        $this->command->schema->getStructure()->each(function ($field) {
            $this->fillable .= "'" . $field->getName() . "',\n";
        });

        return $this->fillable;
    }
}
