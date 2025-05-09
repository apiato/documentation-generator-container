<?php

namespace App\Containers\Vendor\Documentation\Tasks;

use App\Containers\Vendor\Documentation\Traits\DocsGeneratorTrait;
use Apiato\Core\Tasks\Task as AbstractTask;
use DateTime;
use Exception;

class RenderTemplatesTask extends AbstractTask
{
    use DocsGeneratorTrait;

    private string $templatePath;
    private string $outputPath;
    // ['templateKey' => value]
    private array $replaceArray;

    public function __construct()
    {
        $this->templatePath = $this->getPathInDocumentationContainer('/ApiDocJs/Headers/header.template' . config('vendor-documentation.locale', 'en') . '.md');
        $this->outputPath = $this->getPathInDocumentationContainer('/UI/WEB/Views/documentation/header.md');
        $this->replaceArray = [
            'api.domain.test' => config('apiato.api.url'),
            '{{rate-limit-expires}}' => config('apiato.api.throttle.expires'),
            '{{rate-limit-attempts}}' => config('apiato.api.throttle.attempts'),
            '{{access-token-expires-in}}' => $this->minutesToTimeDisplay(config('apiato.api.expires-in')),
            '{{access-token-expires-in-minutes}}' => config('apiato.api.expires-in'),
            '{{refresh-token-expires-in}}' => $this->minutesToTimeDisplay(config('apiato.api.refresh-expires-in')),
            '{{refresh-token-expires-in-minutes}}' => config('apiato.api.refresh-expires-in'),
            '{{pagination-limit}}' => config('repository.pagination.limit'),
        ];
    }

    private function minutesToTimeDisplay($minutes): string
    {
        $seconds = $minutes * 60;

        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");

        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }

    /**
     * Read the markdown header template and fill it with some real data from the .env file.
     * @throws Exception
     */
    public function run(): string
    {
        // read the template file
        try {
            $headerMarkdownContent = file_get_contents($this->templatePath);
        } catch (Exception) {
            throw new Exception('Could not read header template file', 500);
        }

        $headerMarkdownContent = $this->replaceMarkdownContent($headerMarkdownContent, $this->replaceArray);

        // this is what the apidoc.json file will point to, to load the header.md
        // write the actual file
        file_put_contents($this->outputPath, $headerMarkdownContent);

        return $this->outputPath;
    }

    private function replaceMarkdownContent(string $markdownContent, array $replaceArray): array|string
    {
        foreach ($replaceArray as $search => $replace) {
            $markdownContent = str_replace($search, $replace, $markdownContent);
        }

        return $markdownContent;
    }
}
