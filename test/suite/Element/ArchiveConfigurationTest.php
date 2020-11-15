<?php

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit\Framework\TestCase;
use ReflectionObject;

class ArchiveConfigurationTest extends TestCase
{
    public function testConstructor()
    {
        $archive = new ArchiveConfiguration(
            ['foo', 'bar'],
            'baz'
        );

        $this->assertSame(['foo', 'bar'], $archive->exclude());
        $this->assertSame('baz', $archive->rawData());
    }

    public function testConstructorDefaults()
    {
        $archive = new ArchiveConfiguration();

        $this->assertSame([], $archive->exclude());
        $this->assertNull($archive->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(new ArchiveConfiguration());
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
