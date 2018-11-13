<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Helper\ShortSyntaxArray;
use Webfactor\Laravel\Generators\Traits\CanGenerateFile;

class LanguageFileService extends ServiceAbstract implements ServiceInterface
{
    use CanGenerateFile;

    protected $key = 'languageFile';

    public function getConsoleOutput() {
        return 'Added translatable names for this entity to '.$this->command->naming[$this->key]->getRelativeFilePath();
    }

    /**
     * Build the language file.
     *
     * @param string $name
     *
     * @return string
     */
    private function buildFileContent()
    {
        if ($this->filesystem->exists($this->naming->getFile())) {
            $translation = include $this->naming->getFile();
        }

        if (!isset($translation)) {
            $translation = [];
        }

        $translation = array_add($translation, $this->naming->getName(), [
            'singular' => $this->naming->getSingular(),
            'plural'   => $this->naming->getPlural(),
        ]);

        $this->fileContent = $this->getTranslationFileContent($translation);
    }

    private function getTranslationFileContent(array $translation)
    {
        $content = ShortSyntaxArray::parse($translation);

        return <<<FILE
<?php

return {$content};
FILE;
    }
}
