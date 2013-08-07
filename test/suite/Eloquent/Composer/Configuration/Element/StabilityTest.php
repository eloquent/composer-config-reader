<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit_Framework_TestCase;

class StabilityTest extends PHPUnit_Framework_TestCase
{
    public function testMultitonInstances()
    {
        $this->assertSame(
            array(
                'DEV' => Stability::DEV(),
                'ALPHA' => Stability::ALPHA(),
                'BETA' => Stability::BETA(),
                'RC' => Stability::RC(),
                'STABLE' => Stability::STABLE(),
            ),
            Stability::multitonInstances()
        );
    }

    public function testInstanceByValueIgnoreCase()
    {
        $this->assertSame(Stability::DEV(), Stability::instanceByValueIgnoreCase('dev'));
        $this->assertSame(Stability::DEV(), Stability::instanceByValueIgnoreCase('Dev'));
        $this->assertSame(Stability::DEV(), Stability::instanceByValueIgnoreCase('DEV'));
    }
}
