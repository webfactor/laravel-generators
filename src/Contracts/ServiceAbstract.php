<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Illuminate\Filesystem\Filesystem;

abstract class ServiceAbstract
{
    protected $command;

    protected $key;

    protected $naming;

    protected $filesystem;

    public function __construct(CommandAbstract $command, ?NamingAbstract $naming = null)
    {
        $this->command = $command;
        $this->filesystem = new Filesystem();

        $this->naming = $naming;

        if (is_null($naming) && $this->key) {
            $this->naming = $this->command->naming[$this->key];
        }
    }

    protected function addGeneratedFileToIdeStack()
    {
        if ($file = $this->command->naming[$this->key]->getFile()) {
            $this->command->addFile($this->getSplFile($file));
        }
    }

    private function getSplFile(string $pathToFile): \SplFileInfo
    {
        $splFile = new \SplFileInfo($pathToFile);

        if ($splFile->isFile()) {
            return $splFile;
        }

        return null;
    }
}
