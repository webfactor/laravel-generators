<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;
use Webfactor\Laravel\Generators\Schemas\ValidationRule;

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

        $this->setRulesFromSchema();
        $this->fillRulesInGeneratedRequest();
    }

    /**
     * @param string $entity
     * @return string
     */
    public function getName(string $entity): string
    {
        return ucfirst($entity);
    }

    private function fillRulesInGeneratedRequest(): void
    {
        $requestFile = end($this->command->filesToBeOpened);

        $request = $this->filesystem->get($requestFile);
        $request = str_replace('__rules__', $this->getRulesAsString(), $request);
        $this->filesystem->put($requestFile, $request);
    }

    private function setRulesFromSchema(): void
    {
        $this->command->schema->getStructure()->each(function ($field) {
            array_push($this->rules, new ValidationRule($field));
        });
    }

    /**
     * @return string
     */
    private function getRulesAsString(): string
    {
        $rulesArray = [];

        foreach ($this->rules as $validationRule) {
            if ($ruleString = $validationRule->generateRuleString()) {
                $rulesArray[$validationRule->getField()] = $ruleString;
            }
        }

        return ShortSyntaxArray::parse($rulesArray);
    }
}
