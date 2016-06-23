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
 * An undefined propery was requested.
 */
final class UndefinedPropertyException extends Exception implements
    ConfigurationExceptionInterface
{
    /**
     * Construct a new undefined property exception.
     *
     * @param string         $property The requested property name.
     * @param Exception|null $previous The cause, if available.
     */
    public function __construct($property, Exception $previous = null)
    {
        $this->property = $property;

        parent::__construct(
            sprintf(
                "Undefined property '%s' in Composer configuration.",
                $this->property()
            ),
            0,
            $previous
        );
    }

    /**
     * Get the requested property name.
     *
     * @return string The property name.
     */
    public function property()
    {
        return $this->property;
    }

    private $property;
}
