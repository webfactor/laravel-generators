<?php

namespace Webfactor\Laravel\Generators\Contracts;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;
use Webfactor\Laravel\Generators\Commands\MakeEntity;

abstract class ServiceAbstract
{
    protected $command;

    protected $filesystem;

    protected $key;

    protected $naming;

    protected $relativeToBasePath;

    public function __construct(MakeEntity $command)
    {
        $this->command = $command;
        $this->filesystem = new Filesystem();
        $this->command->naming[$this->key] = new $this->naming($this->command->entity);
    }

    protected function addLatestFileToIdeStack()
    {
        $this->command->addFile($this->latestCreatedFileIn(base_path($this->relativeToBasePath)));
    }

    /**
     * Returns the latest created File in given Path to use it for $filesToBeOpened stack
     *
     * @param string $path
     *
     * @return SplFileInfo
     */
    protected function latestCreatedFileIn(string $path): SplFileInfo
    {
        $sortedByMTime = array_sort($this->filesystem->files($path), function ($file) {
            return $file->getMTime();
        });

        return end($sortedByMTime);
    }
}
