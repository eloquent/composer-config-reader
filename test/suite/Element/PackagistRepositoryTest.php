<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit_Framework_TestCase;
use ReflectionObject;

class PackagistRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $repository = new PackagistRepository(false, 'foo');

        $this->assertSame('', $repository->type());
        $this->assertFalse($repository->isEnabled());
        $this->assertSame('foo', $repository->rawData());
    }

    public function testConstructorDefaults()
    {
        $repository = new PackagistRepository(true);

        $this->assertNull($repository->rawData());
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject(new PackagistRepository(false));

        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
