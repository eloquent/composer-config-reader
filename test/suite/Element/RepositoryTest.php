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

class RepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $repository = new Repository(
            'foo',
            'bar',
            array('baz' => 'qux'),
            'doom'
        );

        $this->assertSame('foo', $repository->type());
        $this->assertSame('bar', $repository->uri());
        $this->assertSame(array('baz' => 'qux'), $repository->options());
        $this->assertSame('doom', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = new Repository(
            'foo'
        );

        $this->assertNull($repository->uri());
        $this->assertSame(array(), $repository->options());
        $this->assertNull($repository->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(new Repository('foo'));
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
