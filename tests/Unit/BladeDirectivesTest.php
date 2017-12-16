<?php namespace GeneaLabs\LaravelAuthorizationAddons\Tests\Unit;

use GeneaLabs\LaravelAuthorizationAddons\Tests\TestCase;

class BladeDirectivesTest extends TestCase
{
    public function testCanAnyDirectiveIsRegistered()
    {
        $string = '@canAny (\'update\', [$post])';
        $expected = '<?php if (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testCanEveryDirectiveIsRegistered()
    {
        $string = '@canEvery (\'update\', [$post])';
        $expected = '<?php if (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->every(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCanAnyDirectiveIsRegistered()
    {
        $string = '@elseCanAny (\'update\', [$post])';
        $expected = '<?php elseif (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCanEveryDirectiveIsRegistered()
    {
        $string = '@elseCanEvery (\'update\', [$post])';
        $expected = '<?php elseif (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->every(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testCanAnyPerformsExpectedAuthorizationChecks()
    {
        $this->markTestIncomplete();
    }

    public function testCanEveryPerformsExpectedAuthorizationChecks()
    {
        $this->markTestIncomplete();
    }

    public function testElseCanAnyPerformsExpectedAuthorizationChecks()
    {
        $this->markTestIncomplete();
    }

    public function testElseCanEveryPerformsExpectedAuthorizationChecks()
    {
        $this->markTestIncomplete();
    }

    public function testCannotAnyDirectiveIsRegistered()
    {
        $string = '@cannotAny (\'update\', [$post])';
        $expected = '<?php if (! app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testCannotEveryDirectiveIsRegistered()
    {
        $string = '@cannotEvery (\'update\', [$post])';
        $expected = '<?php if (! app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->every(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCannotAnyDirectiveIsRegistered()
    {
        $string = '@elseCannotAny (\'update\', [$post])';
        $expected = '<?php elseif (! app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->any(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCannotEveryDirectiveIsRegistered()
    {
        $string = '@elseCannotEvery (\'update\', [$post])';
        $expected = '<?php elseif (! app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->every(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testCannotAnyPerformsExpectedAuthorizationChecks()
    {
        $this->markTestIncomplete();
    }

    public function testCannotEveryPerformsExpectedAuthorizationChecks()
    {
        $this->markTestIncomplete();
    }

    public function testElseCannotAnyPerformsExpectedAuthorizationChecks()
    {
        $this->markTestIncomplete();
    }

    public function testElseCannotEveryPerformsExpectedAuthorizationChecks()
    {
        $this->markTestIncomplete();
    }
}
