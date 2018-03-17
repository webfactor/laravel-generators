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

    private function getSchema()
    {
        return $this->command->option('schema') ?? $this->options['schema'];
    }
}
