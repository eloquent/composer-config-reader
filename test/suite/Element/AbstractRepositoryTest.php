<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use Phake;
use PHPUnit_Framework_TestCase;

class AbstractRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $repository = Phake::partialMock(
            __NAMESPACE__ . '\AbstractRepository',
            'foo',
            array('bar' => 'baz'),
            'qux'
        );

        $this->assertSame('foo', $repository->type());
        $this->assertSame(array('bar' => 'baz'), $repository->options());
        $this->assertSame('qux', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = Phake::partialMock(
            __NAMESPACE__ . '\AbstractRepository',
            'foo'
        );

        $this->assertSame(array(), $repository->options());
        $this->assertNull($repository->rawData());
    }
}
