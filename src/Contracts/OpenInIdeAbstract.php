<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Webfactor\Laravel\Generators\Commands\MakeEntity;

abstract class OpenInIdeAbstract
{
    protected $files;

    public function __construct(array $files)
    {
        $this->files = $files;
    }
}
