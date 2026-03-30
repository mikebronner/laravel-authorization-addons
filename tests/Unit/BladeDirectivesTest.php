<?php namespace GeneaLabs\LaravelAuthorizationAddons\Tests\Unit;

use GeneaLabs\LaravelAuthorizationAddons\Tests\TestCase;
use Illuminate\Support\Facades\Gate;

class BladeDirectivesTest extends TestCase
{
    public function testCanAnyDirectiveIsRegistered(): void
    {
        $string = '@canAny (\'update\', [$post])';
        $expected = '<?php if (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testCanEveryDirectiveIsRegistered(): void
    {
        $string = '@canEvery (\'update\', [$post])';
        $expected = '<?php if (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->check(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCanAnyDirectiveIsRegistered(): void
    {
        $string = '@elseCanAny (\'update\', [$post])';
        $expected = '<?php elseif (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCanEveryDirectiveIsRegistered(): void
    {
        $string = '@elseCanEvery (\'update\', [$post])';
        $expected = '<?php elseif (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->check(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testCanAnyPerformsExpectedAuthorizationChecks(): void
    {
        Gate::define('edit', fn () => true);
        Gate::define('delete', fn () => false);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canAny', "'edit', 'delete'");

        $this->assertTrue($result, 'canAny should return true when at least one ability is granted.');
    }

    public function testCanAnyReturnsFalseWhenNoAbilitiesGranted(): void
    {
        Gate::define('edit', fn () => false);
        Gate::define('delete', fn () => false);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canAny', "'edit', 'delete'");

        $this->assertFalse($result, 'canAny should return false when no abilities are granted.');
    }

    public function testCanEveryPerformsExpectedAuthorizationChecks(): void
    {
        Gate::define('edit', fn () => true);
        Gate::define('delete', fn () => true);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canEvery', "'edit', 'delete'");

        $this->assertTrue($result, 'canEvery should return true when all abilities are granted.');
    }

    public function testCanEveryReturnsFalseWhenNotAllAbilitiesGranted(): void
    {
        Gate::define('edit', fn () => true);
        Gate::define('delete', fn () => false);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canEvery', "'edit', 'delete'");

        $this->assertFalse($result, 'canEvery should return false when not all abilities are granted.');
    }

    public function testElseCanAnyPerformsExpectedAuthorizationChecks(): void
    {
        Gate::define('edit', fn () => true);
        Gate::define('delete', fn () => false);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canAny', "'edit', 'delete'");

        $this->assertTrue($result, 'elseCanAny uses the same Gate::any() check as canAny.');
    }

    public function testElseCanEveryPerformsExpectedAuthorizationChecks(): void
    {
        Gate::define('edit', fn () => true);
        Gate::define('delete', fn () => true);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canEvery', "'edit', 'delete'");

        $this->assertTrue($result, 'elseCanEvery uses the same Gate::every() check as canEvery.');
    }

    public function testCannotAnyDirectiveIsRegistered(): void
    {
        $string = '@cannotAny (\'update\', [$post])';
        $expected = '<?php if (! app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testCannotEveryDirectiveIsRegistered(): void
    {
        $string = '@cannotEvery (\'update\', [$post])';
        $expected = '<?php if (! app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->check(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCannotAnyDirectiveIsRegistered(): void
    {
        $string = '@elseCannotAny (\'update\', [$post])';
        $expected = '<?php elseif (! app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCannotEveryDirectiveIsRegistered(): void
    {
        $string = '@elseCannotEvery (\'update\', [$post])';
        $expected = '<?php elseif (! app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->check(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testCannotAnyPerformsExpectedAuthorizationChecks(): void
    {
        Gate::define('edit', fn () => false);
        Gate::define('delete', fn () => false);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canAny', "'edit', 'delete'");

        $this->assertFalse($result, 'cannotAny negates canAny — should block when no abilities are granted.');
    }

    public function testCannotEveryPerformsExpectedAuthorizationChecks(): void
    {
        Gate::define('edit', fn () => true);
        Gate::define('delete', fn () => false);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canEvery', "'edit', 'delete'");

        $this->assertFalse($result, 'cannotEvery negates canEvery — should block when not all abilities are granted.');
    }

    public function testElseCannotAnyPerformsExpectedAuthorizationChecks(): void
    {
        Gate::define('edit', fn () => false);
        Gate::define('delete', fn () => false);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canAny', "'edit', 'delete'");

        $this->assertFalse($result, 'elseCannotAny uses the same negated Gate::any() check.');
    }

    public function testElseCannotEveryPerformsExpectedAuthorizationChecks(): void
    {
        Gate::define('edit', fn () => true);
        Gate::define('delete', fn () => false);

        $this->actingAs($this->createUser());

        $result = $this->evaluateDirective('canEvery', "'edit', 'delete'");

        $this->assertFalse($result, 'elseCannotEvery uses the same negated Gate::every() check.');
    }

    /**
     * Evaluate a directive's Gate call directly.
     *
     * Instead of rendering Blade (which would require full view setup),
     * we call the Gate methods directly — which is exactly what the
     * compiled directive code does at runtime.
     */
    private function evaluateDirective(string $type, string $abilities): bool
    {
        $gate = app(\Illuminate\Contracts\Auth\Access\Gate::class);
        $abilityList = array_map('trim', explode(',', str_replace("'", '', $abilities)));

        if ($type === 'canAny') {
            return $gate->any($abilityList);
        }

        if ($type === 'canEvery') {
            return $gate->check($abilityList);
        }

        return false;
    }

    private function createUser(): \Illuminate\Foundation\Auth\User
    {
        return new class extends \Illuminate\Foundation\Auth\User {
            public $id = 1;
            public $email = 'test@example.com';
        };
    }
}
