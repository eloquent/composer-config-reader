<?php

namespace Eloquent\Composer\Configuration;

use Eloquent\Composer\Configuration\Exception\UndefinedPropertyException;
use PHPUnit\Framework\TestCase;

class ObjectAccessTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->data = (object) [];
        $this->data->foo = 'bar';
        $this->objectAccess = new ObjectAccess($this->data);
    }

    public function testConstructor()
    {
        $this->assertSame($this->data, $this->objectAccess->data());
    }

    public function testExists()
    {
        $this->assertTrue($this->objectAccess->exists('foo'));
        $this->assertFalse($this->objectAccess->exists('bar'));
    }

    public function testGet()
    {
        $this->assertSame('bar', $this->objectAccess->get('foo'));
    }

    public function testGetFailure()
    {
        $this->expectException(UndefinedPropertyException::class);
        $this->objectAccess->get('bar');
    }

    public function testGetDefault()
    {
        $this->assertSame('bar', $this->objectAccess->getDefault('foo'));
        $this->assertSame('baz', $this->objectAccess->getDefault('bar', 'baz'));
        $this->assertNull($this->objectAccess->getDefault('bar'));
    }
}
