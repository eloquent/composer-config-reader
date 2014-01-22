<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

use PHPUnit_Framework_TestCase;
use stdClass;

class ObjectAccessTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->data = new stdClass;
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
        $this->setExpectedException(__NAMESPACE__.'\Exception\UndefinedPropertyException');
        $this->objectAccess->get('bar');
    }

    public function testGetDefault()
    {
        $this->assertSame('bar', $this->objectAccess->getDefault('foo'));
        $this->assertSame('baz', $this->objectAccess->getDefault('bar', 'baz'));
        $this->assertNull($this->objectAccess->getDefault('bar'));
    }
}
