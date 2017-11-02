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
 * Represents configuration specific to project-type packages.
 */
class ProjectConfiguration
{
    /**
     * Construct a new project configuration.
     *
     * @param int|null                                                 $processTimeout     The process timeout.
     * @param bool|null                                                $useIncludePath     True if the autoloader should look for classes in the PHP include path.
     * @param InstallationMethod|array<string,InstallationMethod>|null $preferredInstall   The preffered installation method.
     * @param array<integer,string>|null                               $githubProtocols    The protocols to use when cloning from GitHub.
     * @param array<string,string>|null                                $githubOauth        An associative array of domain name to GitHub OAuth token.
     * @param string|null                                              $vendorDir          The vendor directory.
     * @param string|null                                              $binDir             The binary executable directory.
     * @param string|null                                              $cacheDir           The cache directory, or null if unknown.
     * @param string|null                                              $cacheFilesDir      The cache directory for package archives, or null if unknown.
     * @param string|null                                              $cacheRepoDir       The cache directory for package repositories, or null if unknown.
     * @param string|null                                              $cacheVcsDir        The cache directory for version control repositories, or null if unknown.
     * @param int|null                                                 $cacheFilesTtl      The cache time-to-live for package archives in seconds.
     * @param int|null                                                 $cacheFilesMaxsize  The maximum size of the package archive cache in bytes.
     * @param bool|null                                                $prependAutoloader  True if the autoloader should be prepended to existing autoloaders.
     * @param string|null                                              $autoloaderSuffix   The suffix used for the generated autoloader class name.
     * @param bool|null                                                $optimizeAutoloader True if the autoloader should always be optimized.
     * @param array<integer,string>|null                               $githubDomains      The list of domains to use in GitHub mode.
     * @param bool|null                                                $notifyOnInstall    True if the repository should be notified on installation.
     * @param VcsChangePolicy|null                                     $discardChanges     The policy for how to treat version control changes when installing or updating.
     * @param mixed                                                    $rawData            The raw data describing the project configuration.
     */
    public function __construct(
        $processTimeout = null,
        $useIncludePath = null,
        $preferredInstall = null,
        array $githubProtocols = null,
        array $githubOauth = null,
        $vendorDir = null,
        $binDir = null,
        $cacheDir = null,
        $cacheFilesDir = null,
        $cacheRepoDir = null,
        $cacheVcsDir = null,
        $cacheFilesTtl = null,
        $cacheFilesMaxsize = null,
        $prependAutoloader = null,
        $autoloaderSuffix = null,
        $optimizeAutoloader = null,
        array $githubDomains = null,
        $notifyOnInstall = null,
        VcsChangePolicy $discardChanges = null,
        $rawData = null
    ) {
        if (null === $processTimeout) {
            $processTimeout = 300;
        }
        if (null === $useIncludePath) {
            $useIncludePath = false;
        }
        if (null === $preferredInstall) {
            $preferredInstall = InstallationMethod::AUTO();
        }
        if (null === $githubProtocols) {
            $githubProtocols = array('git', 'https');
        }
        if (null === $githubOauth) {
            $githubOauth = array();
        }
        if (null === $vendorDir) {
            $vendorDir = 'vendor';
        }
        if (null === $binDir) {
            $binDir = 'vendor/bin';
        }
        if (null === $cacheFilesDir && null !== $cacheDir) {
            $cacheFilesDir = $cacheDir . '/files';
        }
        if (null === $cacheRepoDir && null !== $cacheDir) {
            $cacheRepoDir = $cacheDir . '/repo';
        }
        if (null === $cacheVcsDir && null !== $cacheDir) {
            $cacheVcsDir = $cacheDir . '/vcs';
        }
        if (null === $cacheFilesTtl) {
            $cacheFilesTtl = 15552000;
        }
        if (null === $cacheFilesMaxsize) {
            $cacheFilesMaxsize = 314572800;
        }
        if (null === $prependAutoloader) {
            $prependAutoloader = true;
        }
        if (null === $optimizeAutoloader) {
            $optimizeAutoloader = false;
        }
        if (null === $githubDomains) {
            $githubDomains = array('github.com');
        }
        if (null === $notifyOnInstall) {
            $notifyOnInstall = true;
        }
        if (null === $discardChanges) {
            $discardChanges = VcsChangePolicy::IGNORE();
        }

        $this->processTimeout = $processTimeout;
        $this->useIncludePath = $useIncludePath;
        $this->preferredInstall = $preferredInstall;
        $this->githubProtocols = $githubProtocols;
        $this->githubOauth = $githubOauth;
        $this->vendorDir = $vendorDir;
        $this->binDir = $binDir;
        $this->cacheDir = $cacheDir;
        $this->cacheFilesDir = $cacheFilesDir;
        $this->cacheRepoDir = $cacheRepoDir;
        $this->cacheVcsDir = $cacheVcsDir;
        $this->cacheFilesTtl = $cacheFilesTtl;
        $this->cacheFilesMaxsize = $cacheFilesMaxsize;
        $this->prependAutoloader = $prependAutoloader;
        $this->autoloaderSuffix = $autoloaderSuffix;
        $this->optimizeAutoloader = $optimizeAutoloader;
        $this->githubDomains = $githubDomains;
        $this->notifyOnInstall = $notifyOnInstall;
        $this->discardChanges = $discardChanges;
        $this->rawData = $rawData;
    }

    /**
     * Get the process timeout.
     *
     * @return int The process timeout.
     */
    public function processTimeout()
    {
        return $this->processTimeout;
    }

    /**
     * Returns true if the autoloader should look for classes in the PHP include
     * path.
     *
     * @return bool True if the autoloader should look for classes in the PHP include path.
     */
    public function useIncludePath()
    {
        return $this->useIncludePath;
    }

    /**
     * Get the preferred installation method.
     *
     * @return InstallationMethod|array<string,InstallationMethod> The preferred installation method.
     */
    public function preferredInstall()
    {
        return $this->preferredInstall;
    }

    /**
     * Get the protocols to use when cloning from GitHub.
     *
     * @return array<integer,string> The protocols to use when cloning from GitHub.
     */
    public function githubProtocols()
    {
        return $this->githubProtocols;
    }

    /**
     * Get the GitHub OAuth tokens.
     *
     * @return array<string,string> The GitHub OAuth tokens.
     */
    public function githubOauth()
    {
        return $this->githubOauth;
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
     * Get the cache directory.
     *
     * @return string|null The cache directory, or null if the directory is unknown.
     */
    public function cacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * Get the cache directory for package archives.
     *
     * @return string|null The cache directory for package archives, or null if the directory is unknown.
     */
    public function cacheFilesDir()
    {
        return $this->cacheFilesDir;
    }

    /**
     * Get the cache directory for package repositories.
     *
     * @return string|null The cache directory for package repositories, or null if the directory is unknown.
     */
    public function cacheRepoDir()
    {
        return $this->cacheRepoDir;
    }

    /**
     * Get the cache directory for version control repositories.
     *
     * @return string|null The cache directory for version control repositories, or null if the directory is unknown.
     */
    public function cacheVcsDir()
    {
        return $this->cacheVcsDir;
    }

    /**
     * Get the cache time-to-live for package archives in seconds.
     *
     * @return int The cache time-to-live for package archives in seconds.
     */
    public function cacheFilesTtl()
    {
        return $this->cacheFilesTtl;
    }

    /**
     * Get the maximum size of the package archive cache in bytes.
     *
     * @return int The maximum size of the package archive cache in bytes.
     */
    public function cacheFilesMaxsize()
    {
        return $this->cacheFilesMaxsize;
    }

    /**
     * Returns true if the autoloader should be prepended to existing
     * autoloaders.
     *
     * @return bool True if the autoloader should be prepended to existing autoloaders.
     */
    public function prependAutoloader()
    {
        return $this->prependAutoloader;
    }

    /**
     * Get the suffix used for the generated autoloader class name.
     *
     * @return string|null The suffix used for the generated autoloader class name, or null if the suffix is random.
     */
    public function autoloaderSuffix()
    {
        return $this->autoloaderSuffix;
    }

    /**
     * Returns true if the autoloader should always be optimized.
     *
     * @return bool True if the autoloader should always be optimized.
     */
    public function optimizeAutoloader()
    {
        return $this->optimizeAutoloader;
    }

    /**
     * Get the list of domains to use in GitHub mode.
     *
     * @return array<integer,string> The list of domains to use in GitHub mode.
     */
    public function githubDomains()
    {
        return $this->githubDomains;
    }

    /**
     * Returns true if notify-on-install is enabled.
     *
     * @return bool True if notify-on-install is enabled.
     */
    public function notifyOnInstall()
    {
        return $this->notifyOnInstall;
    }

    /**
     * Get the policy for how to treat version control changes when installing
     * or updating.
     *
     * @return VcsChangePolicy The policy for how to treat version control changes when installing or updating.
     */
    public function discardChanges()
    {
        return $this->discardChanges;
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

    private $processTimeout;
    private $useIncludePath;
    private $preferredInstall;
    private $githubProtocols;
    private $githubOauth;
    private $vendorDir;
    private $binDir;
    private $cacheDir;
    private $cacheFilesDir;
    private $cacheRepoDir;
    private $cacheVcsDir;
    private $cacheFilesTtl;
    private $cacheFilesMaxsize;
    private $prependAutoloader;
    private $autoloaderSuffix;
    private $optimizeAutoloader;
    private $githubDomains;
    private $notifyOnInstall;
    private $discardChanges;
    private $rawData;
}
