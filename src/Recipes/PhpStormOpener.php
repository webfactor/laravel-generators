<?php

namespace Webfactor\Laravel\Generators\Recipes;

use Webfactor\Laravel\Generators\Contracts\OpenInIdeAbstract;
use Webfactor\Laravel\Generators\Contracts\OpenInIdeInterface;

class PhpStormOpener extends OpenInIdeAbstract implements OpenInIdeInterface
{
    /**
     *  Opens all given files in PhpStorm
     */
    public function open()
    {
        foreach ($this->files as $file) {
            exec('pstorm ' . $file->getPathname());
        }
    }
}
