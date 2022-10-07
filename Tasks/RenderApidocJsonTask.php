<?php

namespace App\Containers\Vendor\Documentation\Tasks;

use App\Ship\Parents\Tasks\Task;

class RenderApidocJsonTask extends Task
{
    private string $templatePath;
    private string $outputPath;
    // ['templateKey' => value]
    private array $replaceArray;

    public function __construct(string $docType)
    {
        //remove last '/' in api prefix
        $apiPrefix = substr(config('apiato.api.prefix'), 0,-1);
        
        $this->templatePath = 'Containers/' . config('vendor-documentation.section_name') . '/Documentation/ApiDocJs/' . $docType . '/apidoc.json';
        $this->outputPath = 'Containers/' . config('vendor-documentation.section_name') . '/Documentation/ApiDocJs/' . $docType . '/apidoc.json';
        $this->replaceArray = [
            'name' => config('app.name'),
            'description' => config('app.name') . ' (' . ucfirst($docType) . ' API) Documentation',
            'title' => 'Welcome to ' . config('app.name'),
            'url' => config('apiato.api.url').$apiPrefix,
            'sampleUrl' => config('vendor-documentation.enable-sending-sample-request') ? config('apiato.api.url').$apiPrefix : null,
        ];
    }

    /**
     * Read the markdown header template and fill it with some real data from the .env file.
     */
    public function run(): string
    {
        // read the template file
        $jsonContent = file_get_contents(app_path($this->templatePath));

        //Decode the JSON data into a PHP array.
        $contentsDecoded = json_decode($jsonContent, true);

        //Modify the variables.
        foreach ($this->replaceArray as $key => $value) {
            $contentsDecoded[$key] = $value;
        }

        //Encode the array back into a JSON string.
        $jsonContent = json_encode($contentsDecoded);

        // this is what the apidoc.json file will point to to load the header.md
        // write the actual file
        $path = app_path($this->outputPath);
        file_put_contents($path, $jsonContent);

        return $path;
    }
}
