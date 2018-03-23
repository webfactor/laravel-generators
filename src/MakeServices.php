<?php

namespace Webfactor\Laravel\Generators;

use Webfactor\Laravel\Generators\Commands\MakeEntity;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Services\MigrationService;

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

    private function callService(ServiceInterface $service)
    {
        $service->call();
    }
}
