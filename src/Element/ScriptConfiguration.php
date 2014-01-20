<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

/**
 * Represents the hook scripts for a package.
 */
class ScriptConfiguration
{
    /**
     * Construct a new script configuration.
     *
     * @param array<string>|null $preInstallCmd        The pre-install commands.
     * @param array<string>|null $postInstallCmd       The post-install commands.
     * @param array<string>|null $preUpdateCmd         The pre-update commands.
     * @param array<string>|null $postUpdateCmd        The post-update commands.
     * @param array<string>|null $prePackageInstall    The pre-package-install commands.
     * @param array<string>|null $postPackageInstall   The post-package-install commands.
     * @param array<string>|null $prePackageUpdate     The pre-package-update commands.
     * @param array<string>|null $postPackageUpdate    The post-package-update commands.
     * @param array<string>|null $prePackageUninstall  The pre-package-uninstall commands.
     * @param array<string>|null $postPackageUninstall The post-package-uninstall commands.
     * @param mixed              $rawData              The raw data describing the script configuration.
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
     * Get the pre-install commands.
     *
     * @return array<string> The pre-install commands.
     */
    public function preInstallCmd()
    {
        return $this->preInstallCmd;
    }

    /**
     * Get the post-install commands.
     *
     * @return array<string> The post-install commands.
     */
    public function postInstallCmd()
    {
        return $this->postInstallCmd;
    }

    /**
     * Get the pre-update commands.
     *
     * @return array<string> The pre-update commands.
     */
    public function preUpdateCmd()
    {
        return $this->preUpdateCmd;
    }

    /**
     * Get the post-update commands.
     *
     * @return array<string> The post-update commands.
     */
    public function postUpdateCmd()
    {
        return $this->postUpdateCmd;
    }

    /**
     * Get the pre-package-install commands.
     *
     * @return array<string> The pre-package-install commands.
     */
    public function prePackageInstall()
    {
        return $this->prePackageInstall;
    }

    /**
     * Get the post-package-install commands.
     *
     * @return array<string> The post-package-install commands.
     */
    public function postPackageInstall()
    {
        return $this->postPackageInstall;
    }

    /**
     * Get the pre-package-update commands.
     *
     * @return array<string> The pre-package-update commands.
     */
    public function prePackageUpdate()
    {
        return $this->prePackageUpdate;
    }

    /**
     * Get the post-package-update commands.
     *
     * @return array<string> The post-package-update commands.
     */
    public function postPackageUpdate()
    {
        return $this->postPackageUpdate;
    }

    /**
     * Get the pre-package-uninstall commands.
     *
     * @return array<string> The pre-package-uninstall commands.
     */
    public function prePackageUninstall()
    {
        return $this->prePackageUninstall;
    }

    /**
     * Get the post-package-uninstall commands.
     *
     * @return array<string> The post-package-uninstall commands.
     */
    public function postPackageUninstall()
    {
        return $this->postPackageUninstall;
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
