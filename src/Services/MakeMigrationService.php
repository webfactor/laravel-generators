<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\MakeServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\MakeServiceInterface;

class MakeMigrationService extends MakeServiceAbstract implements MakeServiceInterface
{
    public function make()
    {
        $this->command->call('make:migration:schema', [
            'name' => $this->getName($this->entity),
            '--model' => 0,
            '--schema' => $this->getSchema(),
        ]);
    }

    public function getName(string $entity): string
    {
        return 'create_' . snake_case(str_plural($entity)) . '_table';
    }

    private function getSchema()
    {
        return $this->command->option('schema') ?? 'name:string';
    }
}
