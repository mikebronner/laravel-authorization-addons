<?php namespace GeneaLabs\LaravelAuthorizationAddOns;

class AuthorizationAddOns
{
    public function canAny(string $expression)
    {
        return "<?php if (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->checkAny({$expression})): ?>";
    }

    public function canEvery(string $expression)
    {
        return "<?php if (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->checkEvery({$expression})): ?>";
    }

    public function elseCanAny(string $expression)
    {
        return "<?php elseif (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->checkAny({$expression})): ?>";
    }

    public function elseCanEvery(string $expression)
    {
        return "<?php elseif (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->checkEvery({$expression})): ?>";
    }
}
