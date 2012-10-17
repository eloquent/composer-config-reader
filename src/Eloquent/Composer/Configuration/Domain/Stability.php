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

use Eloquent\Enumeration\Enumeration;

final class Stability extends Enumeration
{
    const DEV = 'dev';
    const ALPHA = 'alpha';
    const BETA = 'beta';
    const RC = 'rc';
    const STABLE = 'stable';

    /**
     * @param scalar $value
     *
     * @return Stability
     */
    public static final function instanceByValueIgnoreCase($value)
    {
        return parent::instanceByValue(mb_strtolower($value));
    }
}
