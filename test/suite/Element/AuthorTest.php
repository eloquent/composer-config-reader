<?php

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit\Framework\TestCase;
use ReflectionObject;

class AuthorTest extends TestCase
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
