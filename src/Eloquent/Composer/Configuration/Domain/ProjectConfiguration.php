<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Domain;

class ProjectConfiguration
{
    /**
     * @param string $vendorDir
     * @param string $binDir
     * @param integer $processTimeout
     * @param boolean $notifyOnInstall
     * @param array<string> $githubProtocols
     * @param mixed $rawData
     */
    public function __construct(
        $vendorDir = 'vendor',
        $binDir = 'vendor/bin',
        $processTimeout = 300,
        $notifyOnInstall = true,
        array $githubProtocols = array('git', 'https', 'http'),
        $rawData = null
    ) {
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
