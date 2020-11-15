<?php

namespace Eloquent\Composer\Configuration\Exception;

use Exception;
use PHPUnit\Framework\TestCase;

class InvalidConfigurationExceptionTest extends TestCase
{
    public function testConstructor()
    {
        $errors = [
            [
                'property' => 'foo',
                'message' => 'bar',
            ],
            [
                'property' => 'baz',
                'message' => 'qux',
            ],
        ];
        $previous = new Exception();
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
