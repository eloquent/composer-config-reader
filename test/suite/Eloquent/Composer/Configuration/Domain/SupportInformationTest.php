<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Domain;

use PHPUnit_Framework_TestCase;

class SupportInformationTest extends PHPUnit_Framework_TestCase
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
        $repository = new SupportInformation;

        $this->assertNull($repository->email());
        $this->assertNull($repository->issues());
        $this->assertNull($repository->forum());
        $this->assertNull($repository->wiki());
        $this->assertNull($repository->irc());
        $this->assertNull($repository->source());
        $this->assertNull($repository->rawData());
    }
}
