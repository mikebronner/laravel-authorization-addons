<?php namespace GeneaLabs\LaravelAuthorizationAddons\Providers;

use Blade;
use GeneaLabs\LaravelAuthorizationAddons\AuthorizationAddOns;
use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{
    protected $defer = false;

    protected function registerBladeDirective(string $directive, string $alias = null)
    {
        $directive = $alias ?: $directive;

        if (array_key_exists($directive, Blade::getCustomDirectives())) {
            throw new Exception("Blade directive '{$directive}' is already registered.");
        }

        app('blade.compiler')->directive($directive, function ($parameters) use ($directive) {
            $parameters = trim($parameters, "()");

            return (new AuthorizationAddOns)->{$directive}($parameters);
        });
    }

    public function boot()
    {
        $this->registerBladeDirective('canAny');
        $this->registerBladeDirective('canEvery');
        $this->registerBladeDirective('elseCanAny');
        $this->registerBladeDirective('elseCanEvery');
    }

    public function provides() : array
    {
        return ['genealabs-laravel-authorization-addons'];
    }
}
