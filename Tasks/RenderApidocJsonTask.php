<?php

namespace App\Containers\Vendor\Documentation\Tasks;

use App\Containers\Vendor\Documentation\Traits\DocsGeneratorTrait;
use Apiato\Core\Abstracts\Tasks\Task as AbstractTask;

class RenderApidocJsonTask extends AbstractTask
{
    use DocsGeneratorTrait;

    private string $templatePath;
    private string $outputPath;
    // ['templateKey' => value]
    private array $replaceArray;

    public function __construct(string $docType)
    {
        $this->templatePath = $this->getPathInDocumentationContainer('/ApiDocJs/apidoc.template.json');
        $this->outputPath = $this->getJsonFilePath($docType);
        $this->replaceArray = [
            'name' => config('app.name'),
            'description' => config('app.name') . ' (' . ucfirst($docType) . ' API) Documentation',
            'title' => 'Welcome to ' . config('app.name'),
            'url' => $this->getFullUrl(),
            'sampleUrl' => config('vendor-documentation.enable-sending-sample-request') ? $this->getFullUrl() : null,
        ];
    }

    private function getFullUrl(): string
    {
        return config('apiato.api.url') . $this->prepareUrlPrefix();
    }

    private function prepareUrlPrefix(): string
    {
        return rtrim(config('apiato.api.prefix'), '/');
    }

    /**
     * Read the markdown header template and fill it with some real data from the .env file.
     */
    public function run(): string
    {
        // read the template file
        $jsonContent = file_get_contents($this->templatePath);

        //Decode the JSON data into a PHP array.
        $contentsDecoded = json_decode($jsonContent, true);

        //Modify the variables.
        foreach ($this->replaceArray as $key => $value) {
            $contentsDecoded[$key] = $value;
        }

        //Encode the array back into a JSON string.
        $jsonContent = json_encode($contentsDecoded);

        // this is what the apidoc.json file will point to, to load the header.md
        // write the actual file
        $this->fileForceContents($this->outputPath, $jsonContent);

        return $this->outputPath;
    }

    // File put contents fails if you try to put a file in a directory that doesn't exist.
    // This creates the directory.
    private function fileForceContents($dir, $contents): void
    {
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';

        foreach ($parts as $part)
            if (!is_dir($dir .= "/$part")) mkdir($dir);

        file_put_contents("$dir/$file", $contents);
    }
}
