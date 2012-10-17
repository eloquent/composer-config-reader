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

class ScriptConfiguration
{
    /**
     * @param array<string>|null $preInstallCmd
     * @param array<string>|null $postInstallCmd
     * @param array<string>|null $preUpdateCmd
     * @param array<string>|null $postUpdateCmd
     * @param array<string>|null $prePackageInstall
     * @param array<string>|null $postPackageInstall
     * @param array<string>|null $prePackageUpdate
     * @param array<string>|null $postPackageUpdate
     * @param array<string>|null $prePackageUninstall
     * @param array<string>|null $postPackageUninstall
     * @param mixed $rawData
     */
    public function __construct(
        array $preInstallCmd = null,
        array $postInstallCmd = null,
        array $preUpdateCmd = null,
        array $postUpdateCmd = null,
        array $prePackageInstall = null,
        array $postPackageInstall = null,
        array $prePackageUpdate = null,
        array $postPackageUpdate = null,
        array $prePackageUninstall = null,
        array $postPackageUninstall = null,
        $rawData = null
    ) {
        if (null === $preInstallCmd) {
            $preInstallCmd = array();
        }
        if (null === $postInstallCmd) {
            $postInstallCmd = array();
        }
        if (null === $preUpdateCmd) {
            $preUpdateCmd = array();
        }
        if (null === $postUpdateCmd) {
            $postUpdateCmd = array();
        }
        if (null === $prePackageInstall) {
            $prePackageInstall = array();
        }
        if (null === $postPackageInstall) {
            $postPackageInstall = array();
        }
        if (null === $prePackageUpdate) {
            $prePackageUpdate = array();
        }
        if (null === $postPackageUpdate) {
            $postPackageUpdate = array();
        }
        if (null === $prePackageUninstall) {
            $prePackageUninstall = array();
        }
        if (null === $postPackageUninstall) {
            $postPackageUninstall = array();
        }

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
