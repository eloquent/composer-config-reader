<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
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

        $this->_data = new stdClass;
        $this->_data->foo = 'bar';
        $this->_objectAccess = new ObjectAccess($this->_data);
    }

    public function testConstructor()
    {
        $this->assertSame($this->_data, $this->_objectAccess->data());
    }

    public function testExists()
    {
        $this->assertTrue($this->_objectAccess->exists('foo'));
        $this->assertFalse($this->_objectAccess->exists('bar'));
    }

    public function testGet()
    {
        $this->assertSame('bar', $this->_objectAccess->get('foo'));
    }

    public function testGetFailure()
    {
        $this->setExpectedException(__NAMESPACE__.'\Exception\UndefinedPropertyException');
        $this->_objectAccess->get('bar');
    }

    public function testGetDefault()
    {
        $this->assertSame('bar', $this->_objectAccess->getDefault('foo'));
        $this->assertSame('baz', $this->_objectAccess->getDefault('bar', 'baz'));
        $this->assertNull($this->_objectAccess->getDefault('bar'));
    }
}
