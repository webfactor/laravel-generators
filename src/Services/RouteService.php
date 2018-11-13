<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class RouteService extends ServiceAbstract implements ServiceInterface
{
    protected $key = 'routeFile';

    public function getConsoleOutput() {
        return 'Added route to '.$this->command->naming[$this->key]->getRelativeFilePath();
    }

    public function call()
    {
        $routeFile = $this->naming->getFile();

        if ($this->filesystem->exists($routeFile)) {
            $this->addRoute($routeFile);
            $this->addGeneratedFileToIdeStack();
        }
    }

    private function getRouteString()
    {
        return 'CRUD::resource(\'' . $this->naming->getName() . '\', \'' . $this->command->naming['crudController']->getClassName() . '\');';
    }

    private function addRoute($routeFile)
    {
        $old_file_content = $this->filesystem->get($routeFile);

        // insert the given code before the file's last line
        $file_lines = preg_split('/\r\n|\r|\n/', $old_file_content);
        if ($end_line_number = $this->getRoutesFileEndLine($file_lines)) {
            $file_lines[$end_line_number + 1] = $file_lines[$end_line_number];
            $file_lines[$end_line_number] = '    ' . $this->getRouteString();
            $new_file_content = implode(PHP_EOL, $file_lines);

            $this->filesystem->put($routeFile, $new_file_content);
        } else {
            $this->filesystem->append($routeFile, PHP_EOL . $this->getRouteString());
        }
    }

    private function getRoutesFileEndLine($file_lines)
    {
        // in case the last line has not been modified at all
        $end_line_number = array_search('}); // this should be the absolute last line of this file', $file_lines);

        if ($end_line_number) {
            return $end_line_number;
        }

        // otherwise, in case the last line HAS been modified
        // return the last line that has an ending in it
        $possible_end_lines = array_filter($file_lines, function ($k) {
            return strpos($k, '});') === 0;
        });

        if ($possible_end_lines) {
            end($possible_end_lines);
            $end_line_number = key($possible_end_lines);

            return $end_line_number;
        }
    }
}
