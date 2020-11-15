<?php

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit\Framework\TestCase;
use ReflectionObject;

class SupportInformationTest extends TestCase
{
    public function testConstructor()
    {
        $repository = new SupportInformation(
            'foo',
            'bar',
            'baz',
            'qux',
            'doom',
            'splat',
            'ping'
        );

        $this->assertSame('foo', $repository->email());
        $this->assertSame('bar', $repository->issues());
        $this->assertSame('baz', $repository->forum());
        $this->assertSame('qux', $repository->wiki());
        $this->assertSame('doom', $repository->irc());
        $this->assertSame('splat', $repository->source());
        $this->assertSame('ping', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = new SupportInformation();

        $this->assertNull($repository->email());
        $this->assertNull($repository->issues());
        $this->assertNull($repository->forum());
        $this->assertNull($repository->wiki());
        $this->assertNull($repository->irc());
        $this->assertNull($repository->source());
        $this->assertNull($repository->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(new SupportInformation());
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
