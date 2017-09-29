<?php namespace GeneaLabs\LaravelAuthorizationAddons\Tests\Unit;

use GeneaLabs\LaravelAuthorizationAddons\Tests\TestCase;

class BladeDirectivesTest extends TestCase
{
    public function testCanAnyDirectiveIsRegistered()
    {
        $string = '@canAny (\'update\', [$post])';
        $expected = '<?php if (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->checkAny(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testCanEveryDirectiveIsRegistered()
    {
        $string = '@canEvery (\'update\', [$post])';
        $expected = '<?php if (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->checkEvery(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCanAnyDirectiveIsRegistered()
    {
        $string = '@elseCanAny (\'update\', [$post])';
        $expected = '<?php elseif (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->checkAny(\'update\', [$post])): ?>';

        $this->assertEquals($expected, app('blade.compiler')->compileString($string));
    }

    public function testElseCanEveryDirectiveIsRegistered()
    {
        $string = '@elseCanEvery (\'update\', [$post])';
        $expected = '<?php elseif (app(\\Illuminate\\Contracts\\Auth\\Access\\Gate::class)->checkEvery(\'update\', [$post])): ?>';

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
}
