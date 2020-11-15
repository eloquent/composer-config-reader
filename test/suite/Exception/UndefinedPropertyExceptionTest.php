<?php

namespace Eloquent\Composer\Configuration\Exception;

use Exception;
use PHPUnit\Framework\TestCase;

class UndefinedPropertyExceptionTest extends TestCase
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
