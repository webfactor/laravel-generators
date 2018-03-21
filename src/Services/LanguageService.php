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

    private $files;

    public function __construct(MakeEntity $command)
    {
        parent::__construct($command);

        $this->files = new Filesystem();
    }

    public function call()
    {
        $this->currentLanguage = \Lang::locale();
        $this->languageFile = $this->getFilePath();

        $this->writeFile($this->getName($this->command->entity));
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
        if ($this->files->exists($this->languageFile)) {
            $this->translation = include $this->languageFile;
        }

        $this->translation = array_add($this->translation, $name, [
            'singular' => ucfirst($name),
            'plural'   => ucfirst(str_plural($name)),
        ]);

        return $this->files->put($this->languageFile, $this->getTranslationFileContent());
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
