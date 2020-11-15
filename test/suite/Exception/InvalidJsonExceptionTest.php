<?php

namespace Eloquent\Composer\Configuration\Exception;

use Exception;
use PHPUnit\Framework\TestCase;

class InvalidJsonExceptionTest extends TestCase
{
    public function exceptionData()
    {
        return [
            [
                "Invalid JSON in Composer configuration at '/foo/bar': The maximum stack depth has been exceeded.",
                JSON_ERROR_DEPTH,
            ],
            [
                "Invalid JSON in Composer configuration at '/foo/bar': Invalid or malformed JSON.",
                JSON_ERROR_STATE_MISMATCH,
            ],
            [
                "Invalid JSON in Composer configuration at '/foo/bar': Control character error, possibly incorrectly encoded.",
                JSON_ERROR_CTRL_CHAR,
            ],
            [
                "Invalid JSON in Composer configuration at '/foo/bar': Syntax error.",
                JSON_ERROR_SYNTAX,
            ],
            [
                "Invalid JSON in Composer configuration at '/foo/bar': Malformed UTF-8 characters, possibly incorrectly encoded.",
                JSON_ERROR_UTF8,
            ],
            [
                "Invalid JSON in Composer configuration at '/foo/bar': Unknown error.",
                'baz',
            ],
        ];
    }

    /**
     * @dataProvider exceptionData
     */
    public function testConstructor($expectedMessage, $jsonErrorCode)
    {
        $path = '/foo/bar';
        $previous = new Exception();
        $exception = new InvalidJsonException($path, $jsonErrorCode, $previous);

        $this->assertSame($path, $exception->path());
        $this->assertSame($jsonErrorCode, $exception->jsonErrorCode());
        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
