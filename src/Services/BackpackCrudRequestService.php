<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\MigrationFieldAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;

class BackpackCrudRequestService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'app/Http/Requests/Admin';

    private $rules = [];

    public function call()
    {
        $this->command->call('make:crud-request', [
            'name' => $this->getName($this->command->entity),
        ]);

        $this->addLatestFileToIdeStack();

        $this->setRules();

        $this->insertRulesInGeneratedRequest();
    }

    /**
     * @param string $entity
     * @return string
     */
    public function getName(string $entity): string
    {
        return ucfirst($entity);
    }

    private function setRules(): void
    {
        $this->command->migration->getStructure()->each(function (MigrationFieldAbstract $migrationField) {
            $this->rules[$migrationField->getName()] = $migrationField->getValidationRule();
        });
    }

    private function insertRulesInGeneratedRequest(): void
    {
        $requestFile = end($this->command->filesToBeOpened);

        $request = $this->filesystem->get($requestFile);
        $request = str_replace('__rules__', $this->getRulesAsString(), $request);
        $this->filesystem->put($requestFile, $request);
    }

    /**
     * @return string
     */
    private function getRulesAsString(): string
    {
        return ShortSyntaxArray::parse($this->rules);
    }
}
