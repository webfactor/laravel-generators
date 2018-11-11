<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Illuminate\Console\Command;

abstract class CommandAbstract extends Command
{
    /**
     * Paths to files which should automatically be opened in IDE if the
     * option --ide is set (and IDE capable).
     *
     * @var array
     */
    public $filesToBeOpened = [];

    /**
     * The name of the entity being created.
     *
     * @var string
     */
    public $entity;

    /**
     * The naming classes.
     *
     * @var array
     */
    public $naming = [];

    /**
     * Adds file to $filesToBeOpened stack.
     *
     * @param $file
     * @return void
     */
    public function addFile(?\SplFileInfo $file): void
    {
        if ($file) {
            array_push($this->filesToBeOpened, $file);
        }
    }
}
