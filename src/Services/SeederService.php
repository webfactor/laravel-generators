<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class SeederService extends ServiceAbstract implements ServiceInterface
{
    public function call()
    {
        $this->command->call('make:seeder', [
            'name' => $this->getName($this->command->entity),
        ]);
    }

    public function getName(string $entity): string
    {
        return ucfirst(str_plural($entity)) . 'TableSeeder';
    }
}
