<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit_Framework_TestCase;
use ReflectionObject;

class ArchiveConfigurationTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $archive = new ArchiveConfiguration(
            array('foo', 'bar'),
            'baz'
        );

        $this->assertSame(array('foo', 'bar'), $archive->exclude());
        $this->assertSame('baz', $archive->rawData());
    }

    public function testConstructorDefaults()
    {
        $archive = new ArchiveConfiguration;

        $this->assertSame(array(), $archive->exclude());
        $this->assertNull($archive->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(new ArchiveConfiguration);
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
