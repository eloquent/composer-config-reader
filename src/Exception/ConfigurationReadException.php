<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Exception;

use Exception;

/**
 * The configuration could not be read.
 */
final class ConfigurationReadException extends Exception implements
    ConfigurationExceptionInterface
{
    /**
     * Construct a new configuration read exception.
     *
     * @param string         $path     The path to the configuration.
     * @param Exception|null $previous The cause, if available.
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
     * Get the path to the configuration.
     *
     * @return string The configuration path.
     */
    public function path()
    {
        return $this->path;
    }

    private $path;
}
