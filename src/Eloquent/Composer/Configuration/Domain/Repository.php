<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Domain;

class Repository extends AbstractRepository
{
    /**
     * @param string                   $type
     * @param string|null              $url
     * @param array<string,mixed>|null $options
     * @param mixed                    $rawData
     */
    public function __construct(
        $type,
        $url = null,
        array $options = null,
        $rawData = null
    ) {
        parent::__construct(
            $type,
            $options,
            $rawData
        );

        $this->url = $url;
    }

    /**
     * @return string|null
     */
    public function url()
    {
        return $this->url;
    }

    private $url;
}
