<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

use stdClass;

class ObjectAccess
{
    /**
     * @param stdClass $data
     */
    public function __construct(stdClass $data)
    {
        $this->data = $data;
    }

    /**
     * @return stdClass
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * @param string $property
     *
     * @return boolean
     */
    public function exists($property)
    {
        return property_exists($this->data(), $property);
    }

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function get($property)
    {
        if (!$this->exists($property)) {
            throw new Exception\UndefinedPropertyException($property);
        }

        return $this->data()->$property;
    }

    /**
     * @param string $property
     * @param mixed  $default
     *
     * @return mixed
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
