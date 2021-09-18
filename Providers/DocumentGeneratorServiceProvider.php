<?php

namespace App\Containers\Vendor\Documentation\Providers;

use Illuminate\Support\ServiceProvider;

class DocumentGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../Configs/vendor-documentation.php' => app_path('Ship/Configs/vendor-documentation.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Configs/vendor-documentation.php', 'vendor-documentation'
        );
    }
}
