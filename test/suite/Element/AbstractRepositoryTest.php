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

use Eloquent\Phony\Phpunit\Phony;
use PHPUnit_Framework_TestCase;

class AbstractRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $repository = Phony::partialMock(
            __NAMESPACE__ . '\AbstractRepository',
            array('foo', array('bar' => 'baz'), 'qux')
        )->get();

        $this->assertSame('foo', $repository->type());
        $this->assertSame(array('bar' => 'baz'), $repository->options());
        $this->assertSame('qux', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = Phony::partialMock(
            __NAMESPACE__ . '\AbstractRepository',
            array('foo')
        )->get();

        $this->assertSame(array(), $repository->options());
        $this->assertNull($repository->rawData());
    }
}
