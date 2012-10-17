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

final class UndefinedPropertyException extends RuntimeException implements ConfigurationException
{
    /**
     * @param string $property
     * @param Exception|null $previous
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
     * @return string
     */
    public function property()
    {
        return $this->property;
    }

    private $property;
}
