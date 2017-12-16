<?php namespace GeneaLabs\LaravelAuthorizationAddOns;

class AuthorizationAddOns
{
    public function canAny(string $expression)
    {
        return "<?php if (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any({$expression})): ?>";
    }

    public function canEvery(string $expression)
    {
        return "<?php if (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->every({$expression})): ?>";
    }

    public function elseCanAny(string $expression)
    {
        return "<?php elseif (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any({$expression})): ?>";
    }

    public function elseCanEvery(string $expression)
    {
        return "<?php elseif (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->every({$expression})): ?>";
    }

    public function cannotAny(string $expression)
    {
        return "<?php if (! app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any({$expression})): ?>";
    }

    public function cannotEvery(string $expression)
    {
        return "<?php if (! app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->every({$expression})): ?>";
    }

    public function elseCannotAny(string $expression)
    {
        return "<?php elseif (! app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any({$expression})): ?>";
    }

    public function elseCannotEvery(string $expression)
    {
        return "<?php elseif (! app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->every({$expression})): ?>";
    }
}
