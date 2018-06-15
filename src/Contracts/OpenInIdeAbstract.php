<?php

namespace Webfactor\Laravel\Generators\Contracts;

abstract class OpenInIdeAbstract
{
    protected $files;

    public function __construct(array $files)
    {
        $this->files = $files;
    }
}
