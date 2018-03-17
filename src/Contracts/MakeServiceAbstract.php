<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Webfactor\Laravel\Generators\Commands\MakeEntity;

abstract class MakeServiceAbstract
{
    protected $command;
    protected $options;
    protected $entity;

    public function __construct(MakeEntity $command, array $options)
    {
        $this->command = $command;
        $this->options = $options;
        $this->entity = $command->argument('entity');
    }
}
