<?php

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit\Framework\TestCase;
use ReflectionObject;

class ScriptConfigurationTest extends TestCase
{
    public function testConstructor()
    {
        $scripts = new ScriptConfiguration(
            ['foo', 'bar'],
            ['baz', 'qux'],
            ['doom', 'splat'],
            ['ping', 'pong'],
            ['jim', 'jam'],
            ['jom', 'jem'],
            ['pang', 'peng'],
            ['pung', 'pip'],
            ['pop', 'pap'],
            ['pep', 'pup'],
            ['mit', 'mot'],
            ['mat', 'met'],
            ['rip', 'rap'],
            ['rop', 'rep'],
            ['nip', 'nap'],
            ['nop', 'nep'],
            'mut'
        );

        $this->assertSame(['foo', 'bar'], $scripts->preInstallCmd());
        $this->assertSame(['baz', 'qux'], $scripts->postInstallCmd());
        $this->assertSame(['doom', 'splat'], $scripts->preUpdateCmd());
        $this->assertSame(['ping', 'pong'], $scripts->postUpdateCmd());
        $this->assertSame(['jim', 'jam'], $scripts->preStatusCmd());
        $this->assertSame(['jom', 'jem'], $scripts->postStatusCmd());
        $this->assertSame(['pang', 'peng'], $scripts->prePackageInstall());
        $this->assertSame(['pung', 'pip'], $scripts->postPackageInstall());
        $this->assertSame(['pop', 'pap'], $scripts->prePackageUpdate());
        $this->assertSame(['pep', 'pup'], $scripts->postPackageUpdate());
        $this->assertSame(['mit', 'mot'], $scripts->prePackageUninstall());
        $this->assertSame(['mat', 'met'], $scripts->postPackageUninstall());
        $this->assertSame(['rip', 'rap'], $scripts->preAutoloadDump());
        $this->assertSame(['rop', 'rep'], $scripts->postAutoloadDump());
        $this->assertSame(['nip', 'nap'], $scripts->postRootPackageInstall());
        $this->assertSame(['nop', 'nep'], $scripts->postCreateProjectCmd());
        $this->assertSame('mut', $scripts->rawData());
    }

    public function testConstructorDefaults()
    {
        $scripts = new ScriptConfiguration();

        $this->assertSame([], $scripts->preInstallCmd());
        $this->assertSame([], $scripts->postInstallCmd());
        $this->assertSame([], $scripts->preUpdateCmd());
        $this->assertSame([], $scripts->postUpdateCmd());
        $this->assertSame([], $scripts->preStatusCmd());
        $this->assertSame([], $scripts->postStatusCmd());
        $this->assertSame([], $scripts->prePackageInstall());
        $this->assertSame([], $scripts->postPackageInstall());
        $this->assertSame([], $scripts->prePackageUpdate());
        $this->assertSame([], $scripts->postPackageUpdate());
        $this->assertSame([], $scripts->prePackageUninstall());
        $this->assertSame([], $scripts->postPackageUninstall());
        $this->assertSame([], $scripts->preAutoloadDump());
        $this->assertSame([], $scripts->postAutoloadDump());
        $this->assertSame([], $scripts->postRootPackageInstall());
        $this->assertSame([], $scripts->postCreateProjectCmd());
        $this->assertNull($scripts->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(new ScriptConfiguration());
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
