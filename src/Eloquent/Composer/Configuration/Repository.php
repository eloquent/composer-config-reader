<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

class Repository
{
    /**
     * @param string $type
     * @param string|null $url
     * @param array<string,mixed> $options
     * @param mixed $rawData
     */
    public function __construct(
        $type,
        $url = null,
        array $options = array(),
        $rawData = null
    ) {
        $this->type = $type;
        $this->url = $url;
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
     * @return string|null
     */
    public function url()
    {
        return $this->url;
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
    private $url;
    private $options;
    private $rawData;
}
