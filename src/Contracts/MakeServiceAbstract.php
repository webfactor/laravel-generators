<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Webfactor\Laravel\Generators\Commands\MakeEntity;

abstract class MakeServiceAbstract
{
    protected $command;

    public function __construct(MakeEntity $command)
    {
        $this->command = $command;
    }
}
