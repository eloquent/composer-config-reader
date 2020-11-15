<?php

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
