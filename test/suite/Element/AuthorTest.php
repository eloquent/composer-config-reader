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

class AuthorTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $author = new Author(
            'foo',
            'bar',
            'baz',
            'qux',
            'doom'
        );

        $this->assertSame('foo', $author->name());
        $this->assertSame('bar', $author->email());
        $this->assertSame('baz', $author->homepage());
        $this->assertSame('qux', $author->role());
        $this->assertSame('doom', $author->rawData());
    }

    public function testConstructorDefaults()
    {
        $author = new Author(
            'foo'
        );

        $this->assertNull($author->email());
        $this->assertNull($author->homepage());
        $this->assertNull($author->role());
        $this->assertNull($author->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(new Author('foo'));
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
