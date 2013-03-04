<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Domain;

use PHPUnit_Framework_TestCase;

class AuthorTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $author = new Author(
            'foo',
            'bar',
            'baz',
            'qux',
            'doom'
        );

        $this->assertSame('foo', $author->name());
        $this->assertSame('bar', $author->email());
        $this->assertSame('baz', $author->homepage());
        $this->assertSame('qux', $author->role());
        $this->assertSame('doom', $author->rawData());
    }

    public function testConstructorDefaults()
    {
        $author = new Author(
            'foo'
        );

        $this->assertNull($author->email());
        $this->assertNull($author->homepage());
        $this->assertNull($author->role());
        $this->assertNull($author->rawData());
    }
}
