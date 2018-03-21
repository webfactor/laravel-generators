<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class BackpackCrudRequestService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'app/Http/Requests/Admin';

    private $rules;

    public function call()
    {
        $this->command->call('make:crud-request', [
            'name' => $this->getName($this->command->entity),
        ]);

        $this->addLatestFileToIdeStack();
        $this->fillRulesInGeneratedRequestFromSchema();
    }

    public function getName(string $entity): string
    {
        return ucfirst($entity);
    }

    private function fillRulesInGeneratedRequestFromSchema()
    {
        $requestFile = end($this->command->filesToBeOpened);

        $model = $this->filesystem->get($requestFile);
        $model = str_replace('__rules__', $this->getRulesFromSchema(), $model);
        $this->filesystem->put($requestFile, $model);
    }

    /**
     * @return string
     */
    private function getRulesFromSchema()
    {
        $this->command->schema->getStructure()->each(function ($field) {
            if (!$field->isNullable()) {
                $this->rules .= "'" . $field->getName() . "' => '" . $field->makeValidationRule() . "',\n";
            }
        });

        return $this->rules;
    }
}
