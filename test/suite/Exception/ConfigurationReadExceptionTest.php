<?php

namespace Eloquent\Composer\Configuration\Exception;

use Exception;
use PHPUnit\Framework\TestCase;

class ConfigurationReadExceptionTest extends TestCase
{
    public function testConstructor()
    {
        $path = '/foo/bar';
        $previous = new Exception();
        $exception = new ConfigurationReadException($path, $previous);
        $expectedMessage = "Unable to read Composer configuration from '/foo/bar'.";

        $this->assertSame($path, $exception->path());
        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
