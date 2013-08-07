<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Exception;

use Phake;
use PHPUnit_Framework_TestCase;

class InvalidConfigurationExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $errors = array(
            array(
                'property' => 'foo',
                'message' => 'bar',
            ),
            array(
                'property' => 'baz',
                'message' => 'qux',
            ),
        );
        $previous = Phake::mock('Exception');
        $exception = new InvalidConfigurationException($errors, $previous);
        $expectedMessage = <<<'EOD'
The supplied Composer configuration is invalid:
  - [foo] bar
  - [baz] qux
EOD;

        $this->assertSame($errors, $exception->errors());
        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
