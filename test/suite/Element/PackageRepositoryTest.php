<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit_Framework_TestCase;
use ReflectionObject;

class PackageRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $repository = new PackageRepository(
            array('foo' => 'bar'),
            array('baz' => 'qux'),
            'doom'
        );

        $this->assertSame('package', $repository->type());
        $this->assertSame(array('foo' => 'bar'), $repository->packageData());
        $this->assertSame(array('baz' => 'qux'), $repository->options());
        $this->assertSame('doom', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = new PackageRepository(
            array('foo' => 'bar')
        );

        $this->assertSame(array(), $repository->options());
        $this->assertNull($repository->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(
            new PackageRepository(array('foo' => 'bar'))
        );
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
