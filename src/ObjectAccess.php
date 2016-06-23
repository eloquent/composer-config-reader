<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

use Eloquent\Composer\Configuration\Exception\UndefinedPropertyException;
use stdClass;

/**
 * Facilitates easy access to an object's properties.
 */
class ObjectAccess
{
    /**
     * Construct a new object access utility.
     *
     * @param stdClass $data The internal object.
     */
    public function __construct(stdClass $data)
    {
        $this->data = $data;
    }

    /**
     * Get the internal object.
     *
     * @return stdClass The internal object.
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * Returns true if the specified property exists.
     *
     * @param string $property The property name.
     *
     * @return bool True if the property exists.
     */
    public function exists($property)
    {
        return property_exists($this->data(), $property);
    }

    /**
     * Get the value of the specified property.
     *
     * @param string $property The property name.
     *
     * @return mixed                      The value of the property.
     * @throws UndefinedPropertyException If the property does not exist.
     */
    public function get($property)
    {
        if (!$this->exists($property)) {
            throw new UndefinedPropertyException($property);
        }

        return $this->data()->$property;
    }

    /**
     * Get the value of the specified property, and fall back to a default if
     * the property does not exist.
     *
     * @param string $property The property name.
     * @param mixed  $default  The default value to fall back to.
     *
     * @return mixed The value of the property, or the supplied default.
     */
    public function getDefault($property, $default = null)
    {
        if (!$this->exists($property)) {
            return $default;
        }

        return $this->data()->$property;
    }

    private $data;
}
