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

/**
 * Represents the archiving configuration for a package.
 */
class ArchiveConfiguration
{
    /**
     * Construct a new archive configuration.
     *
     * @param array<integer,string>|null $exclude A list of patterns to exclude from the archive.
     */
    public function __construct(array $exclude = null, $rawData = null)
    {
        if (null === $exclude) {
            $exclude = array();
        }

        $this->exclude = $exclude;
        $this->rawData = $rawData;
    }

    /**
     * Get the patterns of excluded files.
     *
     * @return array<integer,string> The exclude patterns.
     */
    public function exclude()
    {
        return $this->exclude;
    }

    /**
     * Get the raw configuration data.
     *
     * @return mixed The raw configuration data.
     */
    public function rawData()
    {
        return $this->rawData;
    }

    private $exclude;
    private $rawData;
}
