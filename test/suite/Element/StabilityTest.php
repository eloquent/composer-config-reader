<?php

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit\Framework\TestCase;

class StabilityTest extends TestCase
{
    public function testMembers()
    {
        $this->assertSame(
            [
                'DEV' => Stability::DEV(),
                'ALPHA' => Stability::ALPHA(),
                'BETA' => Stability::BETA(),
                'RC' => Stability::RC(),
                'STABLE' => Stability::STABLE(),
            ],
            Stability::members()
        );
    }
}
