<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Domain;

abstract class AbstractRepository
{
    /**
     * @param string $type
     * @param array<string,mixed>|null $options
     * @param mixed $rawData
     */
    public function __construct(
        $type,
        array $options = null,
        $rawData = null
    ) {
        if (null === $options) {
            $options = array();
        }

        $this->type = $type;
        $this->options = $options;
        $this->rawData = $rawData;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return array<string,mixed>
     */
    public function options()
    {
        return $this->options;
    }

    /**
     * @return mixed
     */
    public function rawData()
    {
        return $this->rawData;
    }

    private $type;
    private $options;
    private $rawData;
}
