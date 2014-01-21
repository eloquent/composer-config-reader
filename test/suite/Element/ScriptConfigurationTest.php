<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit_Framework_TestCase;
use ReflectionObject;

class ScriptConfigurationTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $scripts = new ScriptConfiguration(
            array('foo', 'bar'),
            array('baz', 'qux'),
            array('doom', 'splat'),
            array('ping', 'pong'),
            array('jim', 'jam'),
            array('jom', 'jem'),
            array('pang', 'peng'),
            array('pung', 'pip'),
            array('pop', 'pap'),
            array('pep', 'pup'),
            array('mit', 'mot'),
            array('mat', 'met'),
            array('rip', 'rap'),
            array('rop', 'rep'),
            array('nip', 'nap'),
            array('nop', 'nep'),
            'mut'
        );

        $this->assertSame(array('foo', 'bar'), $scripts->preInstallCmd());
        $this->assertSame(array('baz', 'qux'), $scripts->postInstallCmd());
        $this->assertSame(array('doom', 'splat'), $scripts->preUpdateCmd());
        $this->assertSame(array('ping', 'pong'), $scripts->postUpdateCmd());
        $this->assertSame(array('jim', 'jam'), $scripts->preStatusCmd());
        $this->assertSame(array('jom', 'jem'), $scripts->postStatusCmd());
        $this->assertSame(array('pang', 'peng'), $scripts->prePackageInstall());
        $this->assertSame(array('pung', 'pip'), $scripts->postPackageInstall());
        $this->assertSame(array('pop', 'pap'), $scripts->prePackageUpdate());
        $this->assertSame(array('pep', 'pup'), $scripts->postPackageUpdate());
        $this->assertSame(array('mit', 'mot'), $scripts->prePackageUninstall());
        $this->assertSame(array('mat', 'met'), $scripts->postPackageUninstall());
        $this->assertSame(array('rip', 'rap'), $scripts->preAutoloadDump());
        $this->assertSame(array('rop', 'rep'), $scripts->postAutoloadDump());
        $this->assertSame(array('nip', 'nap'), $scripts->postRootPackageInstall());
        $this->assertSame(array('nop', 'nep'), $scripts->postCreateProjectCmd());
        $this->assertSame('mut', $scripts->rawData());
    }

    public function testConstructorDefaults()
    {
        $scripts = new ScriptConfiguration;

        $this->assertSame(array(), $scripts->preInstallCmd());
        $this->assertSame(array(), $scripts->postInstallCmd());
        $this->assertSame(array(), $scripts->preUpdateCmd());
        $this->assertSame(array(), $scripts->postUpdateCmd());
        $this->assertSame(array(), $scripts->preStatusCmd());
        $this->assertSame(array(), $scripts->postStatusCmd());
        $this->assertSame(array(), $scripts->prePackageInstall());
        $this->assertSame(array(), $scripts->postPackageInstall());
        $this->assertSame(array(), $scripts->prePackageUpdate());
        $this->assertSame(array(), $scripts->postPackageUpdate());
        $this->assertSame(array(), $scripts->prePackageUninstall());
        $this->assertSame(array(), $scripts->postPackageUninstall());
        $this->assertSame(array(), $scripts->preAutoloadDump());
        $this->assertSame(array(), $scripts->postAutoloadDump());
        $this->assertSame(array(), $scripts->postRootPackageInstall());
        $this->assertSame(array(), $scripts->postCreateProjectCmd());
        $this->assertNull($scripts->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(new ScriptConfiguration);
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
