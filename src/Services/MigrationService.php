<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Commands\MakeEntity;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class MigrationService extends ServiceAbstract implements ServiceInterface
{
    public function call()
    {
        dd($this->command->schema);

        $this->command->call('make:migration:schema', [
            'name' => $this->getName($this->command->entity),
            '--model' => 0,
            '--schema' => $this->command->option('schema'),
        ]);
    }

    public function getName(string $entity): string
    {
        return 'create_' . snake_case(str_plural($entity)) . '_table';
    }
}
