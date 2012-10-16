<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

class ScriptConfiguration
{
    /**
     * @param array<string> $preInstallCmd
     * @param array<string> $postInstallCmd
     * @param array<string> $preUpdateCmd
     * @param array<string> $postUpdateCmd
     * @param array<string> $prePackageInstall
     * @param array<string> $postPackageInstall
     * @param array<string> $prePackageUpdate
     * @param array<string> $postPackageUpdate
     * @param array<string> $prePackageUninstall
     * @param array<string> $postPackageUninstall
     * @param mixed $rawData
     */
    public function __construct(
        array $preInstallCmd = array(),
        array $postInstallCmd = array(),
        array $preUpdateCmd = array(),
        array $postUpdateCmd = array(),
        array $prePackageInstall = array(),
        array $postPackageInstall = array(),
        array $prePackageUpdate = array(),
        array $postPackageUpdate = array(),
        array $prePackageUninstall = array(),
        array $postPackageUninstall = array(),
        $rawData = null
    ) {
        $this->preInstallCmd = $preInstallCmd;
        $this->postInstallCmd = $postInstallCmd;
        $this->preUpdateCmd = $preUpdateCmd;
        $this->postUpdateCmd = $postUpdateCmd;
        $this->prePackageInstall = $prePackageInstall;
        $this->postPackageInstall = $postPackageInstall;
        $this->prePackageUpdate = $prePackageUpdate;
        $this->postPackageUpdate = $postPackageUpdate;
        $this->prePackageUninstall = $prePackageUninstall;
        $this->postPackageUninstall = $postPackageUninstall;
        $this->rawData = $rawData;
    }

    /**
     * @return array<string>
     */
    public function preInstallCmd()
    {
        return $this->preInstallCmd;
    }

    /**
     * @return array<string>
     */
    public function postInstallCmd()
    {
        return $this->postInstallCmd;
    }

    /**
     * @return array<string>
     */
    public function preUpdateCmd()
    {
        return $this->preUpdateCmd;
    }

    /**
     * @return array<string>
     */
    public function postUpdateCmd()
    {
        return $this->postUpdateCmd;
    }

    /**
     * @return array<string>
     */
    public function prePackageInstall()
    {
        return $this->prePackageInstall;
    }

    /**
     * @return array<string>
     */
    public function postPackageInstall()
    {
        return $this->postPackageInstall;
    }

    /**
     * @return array<string>
     */
    public function prePackageUpdate()
    {
        return $this->prePackageUpdate;
    }

    /**
     * @return array<string>
     */
    public function postPackageUpdate()
    {
        return $this->postPackageUpdate;
    }

    /**
     * @return array<string>
     */
    public function prePackageUninstall()
    {
        return $this->prePackageUninstall;
    }

    /**
     * @return array<string>
     */
    public function postPackageUninstall()
    {
        return $this->postPackageUninstall;
    }

    /**
     * @return mixed
     */
    public function rawData()
    {
        return $this->rawData;
    }

    private $preInstallCmd;
    private $postInstallCmd;
    private $preUpdateCmd;
    private $postUpdateCmd;
    private $prePackageInstall;
    private $postPackageInstall;
    private $prePackageUpdate;
    private $postPackageUpdate;
    private $prePackageUninstall;
    private $postPackageUninstall;
    private $rawData;
}
