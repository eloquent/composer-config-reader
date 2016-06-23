<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * An enumeration of package stabilities.
 */
final class Stability extends AbstractEnumeration
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
}
