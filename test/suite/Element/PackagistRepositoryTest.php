<?php

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit\Framework\TestCase;
use ReflectionObject;

class PackagistRepositoryTest extends TestCase
{
    public function testConstructor()
    {
        $repository = new PackagistRepository(false, 'foo');

        $this->assertSame('', $repository->type());
        $this->assertFalse($repository->isEnabled());
        $this->assertSame('foo', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = new PackagistRepository(true);

        $this->assertNull($repository->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(new PackagistRepository(false));

        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
