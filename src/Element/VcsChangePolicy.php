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
 * An enumeration of version control working copy change policies.
 */
final class VcsChangePolicy extends AbstractEnumeration
{
    /**
     * Ignore working copy changes.
     */
    const IGNORE = false;

    /**
     * Discard working copy changes.
     */
    const DISCARD = true;

    /**
     * Stash working copy changes and re-apply.
     */
    const STASH = 'stash';
}
