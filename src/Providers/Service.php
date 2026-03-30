<?php namespace GeneaLabs\LaravelAuthorizationAddons\Providers;

use GeneaLabs\LaravelAuthorizationAddons\AuthorizationAddOns;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{
    protected function registerBladeDirective(string $directive): void
    {
        Blade::directive($directive, function ($parameters) use ($directive) {
            $parameters = trim($parameters, "()");

            return (new AuthorizationAddOns)->{$directive}($parameters);
        });
    }

    public function boot(): void
    {
        $this->registerBladeDirective('canAny');
        $this->registerBladeDirective('canEvery');
        $this->registerBladeDirective('elseCanAny');
        $this->registerBladeDirective('elseCanEvery');
        $this->registerBladeDirective('cannotAny');
        $this->registerBladeDirective('cannotEvery');
        $this->registerBladeDirective('elseCannotAny');
        $this->registerBladeDirective('elseCannotEvery');
    }

    public function provides(): array
    {
        return ['genealabs-laravel-authorization-addons'];
    }
}
