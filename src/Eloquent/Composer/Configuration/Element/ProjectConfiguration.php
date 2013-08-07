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

/**
 * Represents configuration specific to project-type packages.
 */
class ProjectConfiguration
{
    /**
     * Construct a new project configuration.
     *
     * @param string|null        $vendorDir       The vendor directory.
     * @param string|null        $binDir          The binary executable directory.
     * @param integer|null       $processTimeout  The process timeout.
     * @param boolean|null       $notifyOnInstall True if Composer should notify the repository on installation.
     * @param array<string>|null $githubProtocols The protocols to use when cloning from GitHub.
     * @param mixed              $rawData         The raw data describing the project configuration.
     */
    public function __construct(
        $vendorDir = null,
        $binDir = null,
        $processTimeout = null,
        $notifyOnInstall = null,
        array $githubProtocols = null,
        $rawData = null
    ) {
        if (null === $vendorDir) {
            $vendorDir = 'vendor';
        }
        if (null === $binDir) {
            $binDir = 'vendor/bin';
        }
        if (null === $processTimeout) {
            $processTimeout = 300;
        }
        if (null === $notifyOnInstall) {
            $notifyOnInstall = true;
        }
        if (null === $githubProtocols) {
            $githubProtocols = array('git', 'https', 'http');
        }

        $this->vendorDir = $vendorDir;
        $this->binDir = $binDir;
        $this->processTimeout = $processTimeout;
        $this->notifyOnInstall = $notifyOnInstall;
        $this->githubProtocols = $githubProtocols;
        $this->rawData = $rawData;
    }

    /**
     * Get the vendor directory.
     *
     * @return string The vendor directory.
     */
    public function vendorDir()
    {
        return $this->vendorDir;
    }

    /**
     * Get the binary executable directory.
     *
     * @return string The binary executable directory.
     */
    public function binDir()
    {
        return $this->binDir;
    }

    /**
     * Get the process timeout.
     *
     * @return integer The process timeout.
     */
    public function processTimeout()
    {
        return $this->processTimeout;
    }

    /**
     * Returns true if notify-on-install is enabled.
     *
     * @return boolean True if notify-on-install is enabled.
     */
    public function notifyOnInstall()
    {
        return $this->notifyOnInstall;
    }

    /**
     * Get the protocols to use when cloning from GitHub.
     *
     * @return array<string> The protocols to use when cloning from GitHub.
     */
    public function githubProtocols()
    {
        return $this->githubProtocols;
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

    private $vendorDir;
    private $binDir;
    private $processTimeout;
    private $notifyOnInstall;
    private $githubProtocols;
    private $rawData;
}
