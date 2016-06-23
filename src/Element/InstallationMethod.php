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
 * An enumeration of installation methods.
 */
final class InstallationMethod extends AbstractEnumeration
{
    /**
     * Automatic installation.
     */
    const AUTO = 'auto';

    /**
     * Installation from source.
     */
    const SOURCE = 'source';

    /**
     * Installation from dist.
     */
    const DIST = 'dist';
}
