<?php

namespace Eloquent\Composer\Configuration\Element;

use Eloquent\Phony\Phpunit\Phony;
use PHPUnit\Framework\TestCase;

class AbstractRepositoryTest extends TestCase
{
    public function testConstructor()
    {
        $repository = Phony::partialMock(
            __NAMESPACE__ . '\AbstractRepository',
            ['foo', ['bar' => 'baz'], 'qux']
        )->get();

        $this->assertSame('foo', $repository->type());
        $this->assertSame(['bar' => 'baz'], $repository->options());
        $this->assertSame('qux', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = Phony::partialMock(
            __NAMESPACE__ . '\AbstractRepository',
            ['foo']
        )->get();

        $this->assertSame([], $repository->options());
        $this->assertNull($repository->rawData());
    }
}
