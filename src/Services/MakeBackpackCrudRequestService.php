<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\MakeServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\MakeServiceInterface;

class MakeBackpackCrudRequestService extends MakeServiceAbstract implements MakeServiceInterface
{
    public function make()
    {
        $this->command->call('make:crud-request', [
            'name' => $this->getName($this->entity),
        ]);
    }

    public function getName(string $entity): string
    {
        return ucfirst($entity);
    }
}
