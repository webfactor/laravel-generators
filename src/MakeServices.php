<?php

namespace Webfactor\Laravel\Generators;

use Webfactor\Laravel\Generators\Commands\MakeEntity;
use Webfactor\Laravel\Generators\Contracts\MakeServiceInterface;
use Webfactor\Laravel\Generators\Services\MakeMigrationService;

class MakeServices
{
    private $services;

    private $command;

    public function __construct(MakeEntity $command)
    {
        $this->command = $command;

        $this->services = config('webfactor.generators.services', []);
    }

    public function call()
    {
        foreach ($this->services as $service) {
            $this->callService(new $service($this->command));
        }
    }

    private function callService(MakeServiceInterface $service)
    {
        $service->make();
    }
}
