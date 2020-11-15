<?php

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
