<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\MakeServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\MakeServiceInterface;

class MakeFactoryService extends MakeServiceAbstract implements MakeServiceInterface
{
    public function make()
    {
        $this->command->call('make:factory', [
            'name'    => $this->getName($this->command->entity),
            '--model' => 'Models\\' . $this->getModelName($this->command->entity),
        ]);
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
