<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// @codeCoverageIgnoreStart

namespace Eloquent\Composer\Configuration;

use Eloquent\Enumeration\Enumeration;

final class Stability extends Enumeration
{
    const DEV = 'dev';
    const ALPHA = 'alpha';
    const BETA = 'beta';
    const RC = 'RC';
    const STABLE = 'stable';
}
