<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Exception;

use Phake;
use PHPUnit_Framework_TestCase;

class InvalidJSONExceptionTest extends PHPUnit_Framework_TestCase
{
    public function exceptionData()
    {
        return array(
            array(
                "Invalid JSON in Composer configuration at '/foo/bar': The maximum stack depth has been exceeded.",
                JSON_ERROR_DEPTH
            ),
            array(
                "Invalid JSON in Composer configuration at '/foo/bar': Invalid or malformed JSON.",
                JSON_ERROR_STATE_MISMATCH
            ),
            array(
                "Invalid JSON in Composer configuration at '/foo/bar': Control character error, possibly incorrectly encoded.",
                JSON_ERROR_CTRL_CHAR
            ),
            array(
                "Invalid JSON in Composer configuration at '/foo/bar': Syntax error.",
                JSON_ERROR_SYNTAX
            ),
            array(
                "Invalid JSON in Composer configuration at '/foo/bar': Malformed UTF-8 characters, possibly incorrectly encoded.",
                JSON_ERROR_UTF8
            ),
            array(
                "Invalid JSON in Composer configuration at '/foo/bar': Unknown error.",
                'baz'
            ),
        );
    }

    /**
     * @dataProvider exceptionData
     */
    public function testConstructor($expectedMessage, $jsonErrorCode)
    {
        $path = '/foo/bar';
        $previous = Phake::mock('Exception');
        $exception = new InvalidJSONException($path, $jsonErrorCode, $previous);

        $this->assertSame($path, $exception->path());
        $this->assertSame($jsonErrorCode, $exception->jsonErrorCode());
        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
