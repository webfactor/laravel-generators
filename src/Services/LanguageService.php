<?php

namespace Webfactor\Laravel\Generators\Services;

use Illuminate\Filesystem\Filesystem;
use Webfactor\Laravel\Generators\Commands\MakeEntity;
use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

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
        return <<<FILE
<?php
        
return {$this->exportToShortSyntaxArrayString($this->translation)};
FILE;
    }

    private function exportToShortSyntaxArrayString(array $expression, $indent = 4)
    {
        $object = json_decode(str_replace(['(', ')'], ['&#40', '&#41'], json_encode($expression)), true);
        $export = str_replace(['array (', ')', '&#40', '&#41'], ['[', ']', '(', ')'], var_export($object, true));
        $export = preg_replace("/ => \n[^\S\n]*\[/m", ' => [', $export);
        $export = preg_replace("/ => \[\n[^\S\n]*\]/m", ' => []', $export);
        $spaces = str_repeat(' ', $indent);
        $export = preg_replace("/([ ]{2})(?![^ ])/m", $spaces, $export);
        $export = preg_replace("/^([ ]{2})/m", $spaces, $export);

        return $export;
    }
}
