<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Exception;

use Exception;
use RuntimeException;

final class ConfigurationReadException extends RuntimeException implements ConfigurationException
{
    /**
     * @param string         $path
     * @param Exception|null $previous
     */
    public function __construct($path, Exception $previous = null)
    {
        $this->path = $path;

        parent::__construct(
            sprintf("Unable to read Composer configuration from '%s'.", $path),
            0,
            $previous
        );
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    private $path;
}
