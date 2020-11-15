<?php

namespace Eloquent\Composer\Configuration\Element;

/**
 * Represents the hook scripts for a package.
 */
class ScriptConfiguration
{
    /**
     * Construct a new script configuration.
     *
     * @param array<integer,string>|null $preInstallCmd          The pre-install commands.
     * @param array<integer,string>|null $postInstallCmd         The post-install commands.
     * @param array<integer,string>|null $preUpdateCmd           The pre-update commands.
     * @param array<integer,string>|null $postUpdateCmd          The post-update commands.
     * @param array<integer,string>|null $preStatusCmd           The pre-status commands.
     * @param array<integer,string>|null $postStatusCmd          The post-status commands.
     * @param array<integer,string>|null $prePackageInstall      The pre-package-install commands.
     * @param array<integer,string>|null $postPackageInstall     The post-package-install commands.
     * @param array<integer,string>|null $prePackageUpdate       The pre-package-update commands.
     * @param array<integer,string>|null $postPackageUpdate      The post-package-update commands.
     * @param array<integer,string>|null $prePackageUninstall    The pre-package-uninstall commands.
     * @param array<integer,string>|null $postPackageUninstall   The post-package-uninstall commands.
     * @param array<integer,string>|null $preAutoloadDump        The pre-autoload-dump commands.
     * @param array<integer,string>|null $postAutoloadDump       The post-autoload-dump commands.
     * @param array<integer,string>|null $postRootPackageInstall The post-root-package-install commands.
     * @param array<integer,string>|null $postCreateProjectCmd   The post-create-project commands.
     * @param mixed                      $rawData                The raw data describing the script configuration.
     */
    public function __construct(
        array $preInstallCmd = null,
        array $postInstallCmd = null,
        array $preUpdateCmd = null,
        array $postUpdateCmd = null,
        array $preStatusCmd = null,
        array $postStatusCmd = null,
        array $prePackageInstall = null,
        array $postPackageInstall = null,
        array $prePackageUpdate = null,
        array $postPackageUpdate = null,
        array $prePackageUninstall = null,
        array $postPackageUninstall = null,
        array $preAutoloadDump = null,
        array $postAutoloadDump = null,
        array $postRootPackageInstall = null,
        array $postCreateProjectCmd = null,
        $rawData = null
    ) {
        if (null === $preInstallCmd) {
            $preInstallCmd = [];
        }
        if (null === $postInstallCmd) {
            $postInstallCmd = [];
        }
        if (null === $preUpdateCmd) {
            $preUpdateCmd = [];
        }
        if (null === $postUpdateCmd) {
            $postUpdateCmd = [];
        }
        if (null === $preStatusCmd) {
            $preStatusCmd = [];
        }
        if (null === $postStatusCmd) {
            $postStatusCmd = [];
        }
        if (null === $prePackageInstall) {
            $prePackageInstall = [];
        }
        if (null === $postPackageInstall) {
            $postPackageInstall = [];
        }
        if (null === $prePackageUpdate) {
            $prePackageUpdate = [];
        }
        if (null === $postPackageUpdate) {
            $postPackageUpdate = [];
        }
        if (null === $prePackageUninstall) {
            $prePackageUninstall = [];
        }
        if (null === $postPackageUninstall) {
            $postPackageUninstall = [];
        }
        if (null === $preAutoloadDump) {
            $preAutoloadDump = [];
        }
        if (null === $postAutoloadDump) {
            $postAutoloadDump = [];
        }
        if (null === $postRootPackageInstall) {
            $postRootPackageInstall = [];
        }
        if (null === $postCreateProjectCmd) {
            $postCreateProjectCmd = [];
        }

        $this->preInstallCmd = $preInstallCmd;
        $this->postInstallCmd = $postInstallCmd;
        $this->preUpdateCmd = $preUpdateCmd;
        $this->postUpdateCmd = $postUpdateCmd;
        $this->preStatusCmd = $preStatusCmd;
        $this->postStatusCmd = $postStatusCmd;
        $this->prePackageInstall = $prePackageInstall;
        $this->postPackageInstall = $postPackageInstall;
        $this->prePackageUpdate = $prePackageUpdate;
        $this->postPackageUpdate = $postPackageUpdate;
        $this->prePackageUninstall = $prePackageUninstall;
        $this->postPackageUninstall = $postPackageUninstall;
        $this->preAutoloadDump = $preAutoloadDump;
        $this->postAutoloadDump = $postAutoloadDump;
        $this->postRootPackageInstall = $postRootPackageInstall;
        $this->postCreateProjectCmd = $postCreateProjectCmd;
        $this->rawData = $rawData;
    }

    /**
     * Get the pre-install commands.
     *
     * @return array<integer,string> The pre-install commands.
     */
    public function preInstallCmd()
    {
        return $this->preInstallCmd;
    }

    /**
     * Get the post-install commands.
     *
     * @return array<integer,string> The post-install commands.
     */
    public function postInstallCmd()
    {
        return $this->postInstallCmd;
    }

    /**
     * Get the pre-update commands.
     *
     * @return array<integer,string> The pre-update commands.
     */
    public function preUpdateCmd()
    {
        return $this->preUpdateCmd;
    }

    /**
     * Get the post-update commands.
     *
     * @return array<integer,string> The post-update commands.
     */
    public function postUpdateCmd()
    {
        return $this->postUpdateCmd;
    }

    /**
     * Get the pre-status commands.
     *
     * @return array<integer,string> The pre-status commands.
     */
    public function preStatusCmd()
    {
        return $this->preStatusCmd;
    }

    /**
     * Get the post-status commands.
     *
     * @return array<integer,string> The post-status commands.
     */
    public function postStatusCmd()
    {
        return $this->postStatusCmd;
    }

    /**
     * Get the pre-package-install commands.
     *
     * @return array<integer,string> The pre-package-install commands.
     */
    public function prePackageInstall()
    {
        return $this->prePackageInstall;
    }

    /**
     * Get the post-package-install commands.
     *
     * @return array<integer,string> The post-package-install commands.
     */
    public function postPackageInstall()
    {
        return $this->postPackageInstall;
    }

    /**
     * Get the pre-package-update commands.
     *
     * @return array<integer,string> The pre-package-update commands.
     */
    public function prePackageUpdate()
    {
        return $this->prePackageUpdate;
    }

    /**
     * Get the post-package-update commands.
     *
     * @return array<integer,string> The post-package-update commands.
     */
    public function postPackageUpdate()
    {
        return $this->postPackageUpdate;
    }

    /**
     * Get the pre-package-uninstall commands.
     *
     * @return array<integer,string> The pre-package-uninstall commands.
     */
    public function prePackageUninstall()
    {
        return $this->prePackageUninstall;
    }

    /**
     * Get the post-package-uninstall commands.
     *
     * @return array<integer,string> The post-package-uninstall commands.
     */
    public function postPackageUninstall()
    {
        return $this->postPackageUninstall;
    }

    /**
     * Get the pre-autoload-dump commands.
     *
     * @return array<integer,string> The pre-autoload-dump commands.
     */
    public function preAutoloadDump()
    {
        return $this->preAutoloadDump;
    }

    /**
     * Get the post-autoload-dump commands.
     *
     * @return array<integer,string> The post-autoload-dump commands.
     */
    public function postAutoloadDump()
    {
        return $this->postAutoloadDump;
    }

    /**
     * Get the post-root-package-install commands.
     *
     * @return array<integer,string> The post-root-package-install commands.
     */
    public function postRootPackageInstall()
    {
        return $this->postRootPackageInstall;
    }

    /**
     * Get the post-create-project commands.
     *
     * @return array<integer,string> The post-create-project commands.
     */
    public function postCreateProjectCmd()
    {
        return $this->postCreateProjectCmd;
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
    private $preStatusCmd;
    private $postStatusCmd;
    private $prePackageInstall;
    private $postPackageInstall;
    private $prePackageUpdate;
    private $postPackageUpdate;
    private $prePackageUninstall;
    private $postPackageUninstall;
    private $preAutoloadDump;
    private $postAutoloadDump;
    private $postRootPackageInstall;
    private $postCreateProjectCmd;
    private $rawData;
}
