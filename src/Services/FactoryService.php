<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class FactoryService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'database/factories';

    public function call()
    {
        $this->command->call('make:factory', [
            'name'    => $this->getName($this->command->entity),
            '--model' => 'Models\\' . $this->getModelName($this->command->entity),
        ]);

        $this->addLatestFileToIdeStack();
    }

    public function getName(string $entity): string
    {
        return ucfirst($entity) . 'Factory';
    }

    public function getModelName(string $entity): string
    {
        return ucfirst($entity);
    }
}