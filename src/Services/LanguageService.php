<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;

class LanguageService extends ServiceAbstract implements ServiceInterface
{
    private $languageFile;

    private $translation = [];

    private $currentLanguage;

    public function call()
    {
        $this->currentLanguage = \Lang::locale();
        $this->relativeToBasePath = 'resources/lang/' . $this->currentLanguage;
        $this->languageFile = $this->getFilePath();

        $this->writeFile($this->getName($this->command->entity));

        $this->addLatestFileToIdeStack();
    }

    public function getName(string $entity): string
    {
        return snake_case($entity);
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     */
    private function writeFile($name)
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

    private function getFilePath()
    {
        return resource_path('lang/' . $this->currentLanguage) . '/models.php';
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
