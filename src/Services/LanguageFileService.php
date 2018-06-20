<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;

class LanguageFileService extends ServiceAbstract implements ServiceInterface
{
    protected $key = 'languageFile';

    protected $languageFile;

    protected $translation = [];

    public function call()
    {
        $this->languageFile = $this->naming->getFile();

        $this->generateLanguageFile($this->naming->getName());
        $this->addGeneratedFileToIdeStack();
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     */
    private function generateLanguageFile($name)
    {
        if ($this->filesystem->exists($this->languageFile)) {
            $this->translation = include $this->languageFile;
        }

        $this->translation = array_add($this->translation, $name, [
            'singular' => ucfirst($name),
            'plural'   => ucfirst(str_plural($name)),
        ]);

        return $this->filesystem->put($this->languageFile, $this->getTranslationFileContent());
    }

    private function getTranslationFileContent()
    {
        $content = ShortSyntaxArray::parse($this->translation);

        return <<<FILE
<?php
        
return {$content};
FILE;
    }
}
