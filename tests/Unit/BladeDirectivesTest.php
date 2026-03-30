<?php

use GeneaLabs\LaravelAuthorizationAddons\AuthorizationAddOns;
use GeneaLabs\LaravelAuthorizationAddons\Providers\Service;

// AuthorizationAddOns unit tests

it('compiles canAny to Gate::any()', function () {
    $result = (new AuthorizationAddOns)->canAny("'update', [\$post]");

    expect($result)->toBe("<?php if (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any('update', [\$post])): ?>");
});

it('compiles canEvery to Gate::check()', function () {
    $result = (new AuthorizationAddOns)->canEvery("'update', [\$post]");

    expect($result)->toBe("<?php if (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->check('update', [\$post])): ?>");
});

it('compiles elseCanAny to elseif Gate::any()', function () {
    $result = (new AuthorizationAddOns)->elseCanAny("'update', [\$post]");

    expect($result)->toBe("<?php elseif (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any('update', [\$post])): ?>");
});

it('compiles elseCanEvery to elseif Gate::check()', function () {
    $result = (new AuthorizationAddOns)->elseCanEvery("'update', [\$post]");

    expect($result)->toBe("<?php elseif (app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->check('update', [\$post])): ?>");
});

it('compiles cannotAny to negated Gate::any()', function () {
    $result = (new AuthorizationAddOns)->cannotAny("'update', [\$post]");

    expect($result)->toBe("<?php if (! app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any('update', [\$post])): ?>");
});

it('compiles cannotEvery to negated Gate::check()', function () {
    $result = (new AuthorizationAddOns)->cannotEvery("'update', [\$post]");

    expect($result)->toBe("<?php if (! app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->check('update', [\$post])): ?>");
});

it('compiles elseCannotAny to elseif negated Gate::any()', function () {
    $result = (new AuthorizationAddOns)->elseCannotAny("'update', [\$post]");

    expect($result)->toBe("<?php elseif (! app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any('update', [\$post])): ?>");
});

it('compiles elseCannotEvery to elseif negated Gate::check()', function () {
    $result = (new AuthorizationAddOns)->elseCannotEvery("'update', [\$post]");

    expect($result)->toBe("<?php elseif (! app(\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->check('update', [\$post])): ?>");
});

// Service provider unit tests

it('registers all eight blade directives', function () {
    $expected = [
        'canAny',
        'canEvery',
        'elseCanAny',
        'elseCanEvery',
        'cannotAny',
        'cannotEvery',
        'elseCannotAny',
        'elseCannotEvery',
    ];

    $directives = app('blade.compiler')->getCustomDirectives();

    foreach ($expected as $directive) {
        expect($directives)->toHaveKey($directive);
    }
});

it('registers directives that delegate to AuthorizationAddOns', function () {
    $compiled = app('blade.compiler')->compileString("@canAny('edit', \$post)");

    expect($compiled)->toContain('Gate::class)->any(');
});

it('strips outer parentheses from directive parameters', function () {
    invade(new Service(app()))->registerBladeDirective('canAny');

    $directives = app('blade.compiler')->getCustomDirectives();
    $callback = $directives['canAny'];

    $result = $callback("('edit', \$post)");

    expect($result)->not->toContain('((')
        ->and($result)->toContain("->any('edit', \$post)");
});
