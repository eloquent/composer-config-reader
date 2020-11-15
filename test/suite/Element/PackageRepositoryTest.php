<?php

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit\Framework\TestCase;
use ReflectionObject;

class PackageRepositoryTest extends TestCase
{
    public function testConstructor()
    {
        $repository = new PackageRepository(
            ['foo' => 'bar'],
            ['baz' => 'qux'],
            'doom'
        );

        $this->assertSame('package', $repository->type());
        $this->assertSame(['foo' => 'bar'], $repository->packageData());
        $this->assertSame(['baz' => 'qux'], $repository->options());
        $this->assertSame('doom', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = new PackageRepository(
            ['foo' => 'bar']
        );

        $this->assertSame([], $repository->options());
        $this->assertNull($repository->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(
            new PackageRepository(['foo' => 'bar'])
        );
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
