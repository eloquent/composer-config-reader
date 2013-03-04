<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Domain;

use PHPUnit_Framework_TestCase;

class ProjectConfigurationTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $config = new ProjectConfiguration(
            'foo',
            'bar',
            111,
            false,
            array('baz', 'qux'),
            'doom'
        );

        $this->assertSame('foo', $config->vendorDir());
        $this->assertSame('bar', $config->binDir());
        $this->assertSame(111, $config->processTimeout());
        $this->assertFalse($config->notifyOnInstall());
        $this->assertSame(array('baz', 'qux'), $config->githubProtocols());
        $this->assertSame('doom', $config->rawData());
    }

    public function testConstructorDefaults()
    {
        $config = new ProjectConfiguration;

        $this->assertSame('vendor', $config->vendorDir());
        $this->assertSame('vendor/bin', $config->binDir());
        $this->assertSame(300, $config->processTimeout());
        $this->assertTrue($config->notifyOnInstall());
        $this->assertSame(array('git', 'https', 'http'), $config->githubProtocols());
        $this->assertNull($config->rawData());
    }
}
