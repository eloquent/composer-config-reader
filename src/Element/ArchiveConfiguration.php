<?php

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
            $exclude = [];
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
