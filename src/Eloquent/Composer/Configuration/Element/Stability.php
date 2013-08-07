<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use Eloquent\Enumeration\Enumeration;

/**
 * An enumeration of package stabilities.
 */
final class Stability extends Enumeration
{
    /**
     * Development stability.
     */
    const DEV = 'dev';

    /**
     * Alpha stability.
     */
    const ALPHA = 'alpha';

    /**
     * Beta stability.
     */
    const BETA = 'beta';

    /**
     * Release candidate stability.
     */
    const RC = 'rc';

    /**
     * Stable stability.
     */
    const STABLE = 'stable';

    /**
     * Get a stability by value, ignoring case.
     *
     * @param scalar $value The stability string.
     *
     * @return Stability The stability enumeration value.
     */
    final public static function instanceByValueIgnoreCase($value)
    {
        return parent::instanceByValue(mb_strtolower($value));
    }
}
