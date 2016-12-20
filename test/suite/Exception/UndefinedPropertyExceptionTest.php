<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Exception;

use Exception;
use PHPUnit_Framework_TestCase;

class UndefinedPropertyExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $previous = new Exception();
        $exception = new UndefinedPropertyException('foo', $previous);
        $expectedMessage = "Undefined property 'foo' in Composer configuration.";

        $this->assertSame('foo', $exception->property());
        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
