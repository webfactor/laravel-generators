<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\MakeServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\MakeServiceInterface;

class MakeBackpackCrudService extends MakeServiceAbstract implements MakeServiceInterface
{
    public function make()
    {
        $this->command->call('backpack:crud', [
            'name' => $this->getName($this->entity),
        ]);
    }
}
