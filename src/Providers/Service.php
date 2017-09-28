<?php namespace GeneaLabs\LaravelCaffeine\Providers;

use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {

    }

    public function register()
    {

    }

    public function provides() : array
    {
        return ['genealabs-laravel-authorization-addons'];
    }
}
