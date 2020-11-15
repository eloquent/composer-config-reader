<?php

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit\Framework\TestCase;
use ReflectionObject;

class RepositoryTest extends TestCase
{
    public function testConstructor()
    {
        $repository = new Repository(
            'foo',
            'bar',
            ['baz' => 'qux'],
            'doom'
        );

        $this->assertSame('foo', $repository->type());
        $this->assertSame('bar', $repository->uri());
        $this->assertSame(['baz' => 'qux'], $repository->options());
        $this->assertSame('doom', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = new Repository(
            'foo'
        );

        $this->assertNull($repository->uri());
        $this->assertSame([], $repository->options());
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
