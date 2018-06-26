<?php

namespace Webfactor\Laravel\Generators\Traits;

trait CanGenerateFile
{
    protected $fileContent;

    public function call()
    {
        $this->generateFile();
        $this->addGeneratedFileToIdeStack();
    }

    /**
     * Generate the file and save it according to specified naming.
     *
     * @return void
     */
    protected function generateFile(): void
    {
        if (method_exists($this->naming, 'getStub')) {
            $this->loadStubFile($this->naming->getStub());
        }

        $this->buildFileContent();

        if (!$this->filesystem->isDirectory($this->naming->getPath())) {
            $this->filesystem->makeDirectory($this->naming->getPath(), 0755, true);
        }

        $this->filesystem->put($this->naming->getFile(), $this->fileContent);
    }

    protected function loadStubFile(string $stubFile): void
    {
        try {
            $this->fileContent = $this->filesystem->get($stubFile);
        } catch (FileNotFoundException $exception) {
            $this->command->error('Could not find stub file: ' . $stubFile);
        }
    }

    /**
     * Replace the class namespace in stub file.
     *
     * @return string
     */
    protected function replaceClassNamespace(): void
    {
        $this->fileContent = str_replace('__class_namespace__', $this->naming->getNamespace(), $this->fileContent);
    }

    /**
     * Replace the class name in stub file.
     *
     * @return string
     */
    protected function replaceClassName(): void
    {
        $this->fileContent = str_replace('__class_name__', $this->naming->getClassName(), $this->fileContent);
    }

    /**
     * Replace the table name in stub file.
     *
     * @return string
     */
    protected function replaceTableName(): void
    {
        $this->fileContent = str_replace('__table_name__', $this->command->naming['migration']->getTableName(), $this->fileContent);
    }
}
