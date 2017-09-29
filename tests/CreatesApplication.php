<?php namespace GeneaLabs\LaravelAuthorizationAddons\Tests;

use GeneaLabs\LaravelAuthorizationAddons\Providers\Service as LaravelAuthorizationAddOnsService;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    public function createApplication()
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        $app->register(LaravelAuthorizationAddOnsService::class);

        return $app;
    }
}
