<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class SeederService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'database/seeds';

    public function call()
    {
        $this->command->call('make:seeder', [
            'name' => $this->getName($this->command->entity),
        ]);

        $this->addGeneratedFileToIdeStack();
    }

    public function getName(string $entity): string
    {
        return ucfirst(str_plural($entity)) . 'TableSeeder';
    }
}
