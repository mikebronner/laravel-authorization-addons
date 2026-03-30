<?php namespace GeneaLabs\LaravelAuthorizationAddons\Tests;

use GeneaLabs\LaravelAuthorizationAddons\Providers\Service;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            Service::class,
        ];
    }
}
