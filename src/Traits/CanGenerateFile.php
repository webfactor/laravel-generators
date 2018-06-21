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
        try {
            $this->fileContent = $this->filesystem->get($this->naming->getStub());
        } catch (FileNotFoundException $exception) {
            $this->command->error('Could not find stub file: ' . $this->naming->getStub());
        }

        $this->buildFileContent();

        $this->filesystem->put($this->naming->getFile(), $this->fileContent);
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
        $this->fileContent = str_replace('__table_name__', $this->naming->getTableName(), $this->fileContent);
    }
}
