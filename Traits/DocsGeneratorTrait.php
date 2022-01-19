<?php

namespace App\Containers\Vendor\Documentation\Traits;

trait DocsGeneratorTrait
{
    private function getFullDocsUrl($type): string
    {
        return '> ' . $this->getAppUrl() . '/' . $this->getUrl($type);
    }

    private function getAppUrl()
    {
        return config('app.url');
    }

    private function getUrl($type)
    {
        $configs = $this->getTypeConfig();

        return $configs[$type]['url'];
    }

    private function getTypeConfig()
    {
        return config($this->getConfigFile() . '.types');
    }

    private function getConfigFile(): string
    {
        return 'vendor-documentation';
    }

    private function getDocumentationPath($type): string
    {
        return $this->getHtmlPath() . $this->getFolderName($type);
    }

    private function getHtmlPath()
    {
        return config("{$this->getConfigFile()}.html_files");
    }

    private function getFolderName($type)
    {
        $configs = $this->getTypeConfig();

        return $configs[$type]['folder-name'];
    }

    private function getJsonFilePath($type): string
    {
        return 'app/Containers/' . config('vendor-documentation.section_name') . '/Documentation/ApiDocJs/' . $type . '/apidoc.json';
    }

    private function getExecutable()
    {
        return config($this->getConfigFile() . '.executable');
    }

    private function getEndpointFiles($type): array
    {
        $configs = $this->getTypeConfig();

        // what files types needs to be included
        $routeFilesCommand = [];
        $routes = $configs[$type]['routes'];

        foreach ($routes as $route) {
            $routeFilesCommand[] = '-f';
            $routeFilesCommand[] = $route . '.php';
        }

        return $routeFilesCommand;
    }
}
