<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Domain;

class ProjectConfiguration
{
    /**
     * @param string|null        $vendorDir
     * @param string|null        $binDir
     * @param integer|null       $processTimeout
     * @param boolean|null       $notifyOnInstall
     * @param array<string>|null $githubProtocols
     * @param mixed              $rawData
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
     * @return string
     */
    public function vendorDir()
    {
        return $this->vendorDir;
    }

    /**
     * @return string
     */
    public function binDir()
    {
        return $this->binDir;
    }

    /**
     * @return integer
     */
    public function processTimeout()
    {
        return $this->processTimeout;
    }

    /**
     * @return boolean
     */
    public function notifyOnInstall()
    {
        return $this->notifyOnInstall;
    }

    /**
     * @return array<string>
     */
    public function githubProtocols()
    {
        return $this->githubProtocols;
    }

    /**
     * @return mixed
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
