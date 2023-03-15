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
        $configs = $this->getTypeConfigs();

        return $configs[$type]['url'];
    }

    private function getTypeConfigs()
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
        $configs = $this->getTypeConfigs();

        return $configs[$type]['folder-name'];
    }

    private function getJsonFilePath($type): string
    {
        return $this->getApiDocJsConfigsPath() . '/' . $this->getJsonFileName($type);
    }

    private function getApiDocJsConfigsPath(): string
    {
        return $this->getPathInDocumentationContainer('/ApiDocJs/Configs');
    }

    private function getPathInDocumentationContainer(string $path): string
    {
        return app_path('Containers/' . config('vendor-documentation.section_name') . '/Documentation' . $path);
    }

    private function getJsonFileName($type): string
    {
        return 'apidoc.' . $type . '.json';
    }

    private function getExecutable()
    {
        return config($this->getConfigFile() . '.executable');
    }

    private function getEndpointFiles($type): array
    {
        $configs = $this->getTypeConfigs();

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
