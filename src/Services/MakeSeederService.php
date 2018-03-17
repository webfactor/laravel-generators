<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\MakeServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\MakeServiceInterface;

class MakeSeederService extends MakeServiceAbstract implements MakeServiceInterface
{
    public function make()
    {
        $this->command->call('make:seeder', [
            'name' => $this->getName($this->entity),
        ]);
    }
}
