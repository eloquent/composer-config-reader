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

use DateTime;

/**
 * Represents an entire Composer configuration.
 */
class Configuration
{
    /**
     * The separator used to divide the package name into vendor name and
     * project name.
     */
    const NAME_SEPARATOR = '/';

    /**
     * Construct a new configuration.
     *
     * @param string|null                              $name             The package name.
     * @param string|null                              $description      The package description.
     * @param string|null                              $version          The package version.
     * @param string|null                              $type             The package type.
     * @param array<integer,string>|null               $keywords         The keywords the package is related to.
     * @param string|null                              $homepage         The URI of the package's home page.
     * @param DateTime|null                            $time             The release date of this version.
     * @param array<integer,string>|null               $license          The licences the package is released under.
     * @param array<integer,Author>|null               $authors          The authors of the package.
     * @param SupportInformation|null                  $support          Support information for the package.
     * @param array<string,string>|null                $dependencies     The package's dependencies.
     * @param array<string,string>|null                $devDependencies  The package's development dependencies.
     * @param array<string,string>|null                $conflict         Packages that conflict with this version of the package.
     * @param array<string,string>|null                $replace          Packages that are replaced by this package.
     * @param array<string,string>|null                $provide          Packages that are provided by this package.
     * @param array<string,string>|null                $suggest          Suggested packages for use with this package.
     * @param array<string,array<integer,string>>|null $autoloadPsr4     PSR-4 autoloading configuration for the package.
     * @param array<string,array<integer,string>>|null $autoloadPsr0     PSR-0 autoloading configuration for the package.
     * @param array<integer,string>|null               $autoloadClassmap Class map autoloading configuration for the package.
     * @param array<integer,string>|null               $autoloadFiles    File autoloading configuration for the package.
     * @param array<integer,string>|null               $includePath      Include path autoloading configuration for the package.
     * @param string|null                              $targetDir        The target directory for installation.
     * @param Stability|null                           $minimumStability The minimum stability for packages.
     * @param bool|null                                $preferStable     True if stable packages should take precedence.
     * @param array<integer,RepositoryInterface>       $repositories     The custom repositories used by this package.
     * @param ProjectConfiguration|null                $config           The configuration options for the package that are specific to project-type repositories.
     * @param ScriptConfiguration|null                 $scripts          The hook scripts for the package.
     * @param mixed                                    $extra            Arbitrary extra data contained in the project's configuration.
     * @param array<integer,string>|null               $bin              Binary executable files provided by the package.
     * @param ArchiveConfiguration|null                $archive          The archive configuration for the package.
     * @param mixed                                    $rawData          The raw data describing the configuration.
     */
    public function __construct(
        $name = null,
        $description = null,
        $version = null,
        $type = null,
        array $keywords = null,
        $homepage = null,
        DateTime $time = null,
        array $license = null,
        array $authors = null,
        SupportInformation $support = null,
        array $dependencies = null,
        array $devDependencies = null,
        array $conflict = null,
        array $replace = null,
        array $provide = null,
        array $suggest = null,
        array $autoloadPsr4 = null,
        array $autoloadPsr0 = null,
        array $autoloadClassmap = null,
        array $autoloadFiles = null,
        array $includePath = null,
        $targetDir = null,
        Stability $minimumStability = null,
        $preferStable = null,
        array $repositories = null,
        ProjectConfiguration $config = null,
        ScriptConfiguration $scripts = null,
        $extra = null,
        array $bin = null,
        ArchiveConfiguration $archive = null,
        $rawData = null
    ) {
        if (null === $type) {
            $type = 'library';
        }
        if (null === $keywords) {
            $keywords = array();
        }
        if (null === $license) {
            $license = array();
        }
        if (null === $authors) {
            $authors = array();
        }
        if (null === $support) {
            $support = new SupportInformation();
        }
        if (null === $dependencies) {
            $dependencies = array();
        }
        if (null === $devDependencies) {
            $devDependencies = array();
        }
        if (null === $conflict) {
            $conflict = array();
        }
        if (null === $replace) {
            $replace = array();
        }
        if (null === $provide) {
            $provide = array();
        }
        if (null === $suggest) {
            $suggest = array();
        }
        if (null === $autoloadPsr4) {
            $autoloadPsr4 = array();
        }
        if (null === $autoloadPsr0) {
            $autoloadPsr0 = array();
        }
        if (null === $autoloadClassmap) {
            $autoloadClassmap = array();
        }
        if (null === $autoloadFiles) {
            $autoloadFiles = array();
        }
        if (null === $includePath) {
            $includePath = array();
        }
        if (null === $minimumStability) {
            $minimumStability = Stability::STABLE();
        }
        if (null === $preferStable) {
            $preferStable = false;
        }
        if (null === $repositories) {
            $repositories = array();
        }
        if (null === $config) {
            $config = new ProjectConfiguration();
        }
        if (null === $scripts) {
            $scripts = new ScriptConfiguration();
        }
        if (null === $archive) {
            $archive = new ArchiveConfiguration();
        }
        if (null === $bin) {
            $bin = array();
        }

        $this->name = $name;
        $this->description = $description;
        $this->version = $version;
        $this->type = $type;
        $this->keywords = $keywords;
        $this->homepage = $homepage;
        $this->time = $time;
        $this->license = $license;
        $this->authors = $authors;
        $this->support = $support;
        $this->dependencies = $dependencies;
        $this->devDependencies = $devDependencies;
        $this->conflict = $conflict;
        $this->replace = $replace;
        $this->provide = $provide;
        $this->suggest = $suggest;
        $this->autoloadPsr4 = $autoloadPsr4;
        $this->autoloadPsr0 = $autoloadPsr0;
        $this->autoloadClassmap = $autoloadClassmap;
        $this->autoloadFiles = $autoloadFiles;
        $this->includePath = $includePath;
        $this->targetDir = $targetDir;
        $this->minimumStability = $minimumStability;
        $this->preferStable = $preferStable;
        $this->repositories = $repositories;
        $this->config = $config;
        $this->scripts = $scripts;
        $this->extra = $extra;
        $this->bin = $bin;
        $this->archive = $archive;
        $this->rawData = $rawData;
    }

    /**
     * Get the package name, including vendor and project names.
     *
     * @return string|null The name.
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get the project name, without the vendor prefix.
     *
     * @return string|null The project name.
     */
    public function projectName()
    {
        $name = $this->name();
        if (null === $name) {
            return null;
        }

        $atoms = explode(static::NAME_SEPARATOR, $name);

        return array_pop($atoms);
    }

    /**
     * Get the vendor name, without the project suffix.
     *
     * @return string|null The vendor name.
     */
    public function vendorName()
    {
        $name = $this->name();
        if (null === $name) {
            return null;
        }

        $atoms = explode(static::NAME_SEPARATOR, $name);
        array_pop($atoms);
        if (count($atoms) < 1) {
            return null;
        }

        return implode(static::NAME_SEPARATOR, $atoms);
    }

    /**
     * Get the package description.
     *
     * @return string|null The description.
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * Get the package version.
     *
     * @return string|null The version.
     */
    public function version()
    {
        return $this->version;
    }

    /**
     * Get the package type.
     *
     * @return string The type.
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * Get the package keywords.
     *
     * @return array<integer,string> The keywords.
     */
    public function keywords()
    {
        return $this->keywords;
    }

    /**
     * Get the URI of the package's home page.
     *
     * @return string|null The home page.
     */
    public function homepage()
    {
        return $this->homepage;
    }

    /**
     * Get the release date of this version.
     *
     * @return DateTime|null The release date.
     */
    public function time()
    {
        return $this->time;
    }

    /**
     * Get the licences the package is released under.
     *
     * @return array<integer,string>|null The licences.
     */
    public function license()
    {
        return $this->license;
    }

    /**
     * Get the authors of the package.
     *
     * @return array<integer,Author> The authors.
     */
    public function authors()
    {
        return $this->authors;
    }

    /**
     * Get support information for the package.
     *
     * @return SupportInformation The support information.
     */
    public function support()
    {
        return $this->support;
    }

    /**
     * Get the package's dependencies, excluding development dependencies.
     *
     * @return array<string,string> The dependencies.
     */
    public function dependencies()
    {
        return $this->dependencies;
    }

    /**
     * Get the package's development dependencies.
     *
     * @return array<string,string> The development dependencies.
     */
    public function devDependencies()
    {
        return $this->devDependencies;
    }

    /**
     * Get all of the package's dependencies, including development, and
     * non-development dependencies.
     *
     * @return array<string,string> All dependencies.
     */
    public function allDependencies()
    {
        return array_merge(
            $this->dependencies(),
            $this->devDependencies()
        );
    }

    /**
     * Get the packages that conflict with this version of the package.
     *
     * @return array<string,string> The conflicting packages.
     */
    public function conflict()
    {
        return $this->conflict;
    }

    /**
     * Get the packages that are replaced by this package.
     *
     * @return array<string,string> The replaced packages.
     */
    public function replace()
    {
        return $this->replace;
    }

    /**
     * Get the packages that are provided by this package.
     *
     * @return array<string,string> The provided packages.
     */
    public function provide()
    {
        return $this->provide;
    }

    /**
     * Get suggested packages for use with this package.
     *
     * @return array<string,string> The suggested packages.
     */
    public function suggest()
    {
        return $this->suggest;
    }

    /**
     * Get the PSR-4 autoloading configuration for the package.
     *
     * @return array<string,array<integer,string>> The PSR-4 autoloading configuration.
     */
    public function autoloadPsr4()
    {
        return $this->autoloadPsr4;
    }

    /**
     * Get the PSR-0 autoloading configuration for the package.
     *
     * @return array<string,array<integer,string>> The PSR-0 autoloading configuration.
     */
    public function autoloadPsr0()
    {
        return $this->autoloadPsr0;
    }

    /**
     * Get the class map autoloading configuration for the package.
     *
     * @return array<integer,string> The class map autoloading configuration.
     */
    public function autoloadClassmap()
    {
        return $this->autoloadClassmap;
    }

    /**
     * Get the file autoloading configuration for the package.
     *
     * @return array<integer,string> The file autoloading configuration for the package.
     */
    public function autoloadFiles()
    {
        return $this->autoloadFiles;
    }

    /**
     * Get the include path autoloading configuration for the package.
     *
     * @return array<integer,string> The include path autoloading configuration for the package.
     */
    public function includePath()
    {
        return $this->includePath;
    }

    /**
     * Get an array of all source paths containing PSR-4 conformant code.
     *
     * @return array<integer,string> The PSR-4 source paths.
     */
    public function allPsr4SourcePaths()
    {
        $autoloadPsr4Paths = array();
        foreach ($this->autoloadPsr4() as $namespace => $paths) {
            $autoloadPsr4Paths = array_merge($autoloadPsr4Paths, $paths);
        }

        return $autoloadPsr4Paths;
    }

    /**
     * Get an array of all source paths containing PSR-0 conformant code.
     *
     * @return array<integer,string> The PSR-0 source paths.
     */
    public function allPsr0SourcePaths()
    {
        $autoloadPsr0Paths = array();
        foreach ($this->autoloadPsr0() as $namespace => $paths) {
            $autoloadPsr0Paths = array_merge($autoloadPsr0Paths, $paths);
        }

        return $autoloadPsr0Paths;
    }

    /**
     * Get an array of all source paths for this package.
     *
     * @return array<integer,string> All source paths.
     */
    public function allSourcePaths()
    {
        return array_merge(
            $this->allPsr4SourcePaths(),
            $this->allPsr0SourcePaths(),
            $this->autoloadClassmap(),
            $this->autoloadFiles(),
            $this->includePath()
        );
    }

    /**
     * Get the target directory for installation.
     *
     * @return string|null The target directory.
     */
    public function targetDir()
    {
        return $this->targetDir;
    }

    /**
     * Get the minimum stability for packages.
     *
     * @return Stability The minimum stability.
     */
    public function minimumStability()
    {
        return $this->minimumStability;
    }

    /**
     * Returns true if stable packages should take precedence.
     *
     * @return bool True if stable packages should take precedence.
     */
    public function preferStable()
    {
        return $this->preferStable;
    }

    /**
     * Get the custom repositories used by this package.
     *
     * @return array<integer,RepositoryInterface> The custom repositories.
     */
    public function repositories()
    {
        return $this->repositories;
    }

    /**
     * Get the configuration options for the package that are specific to
     * project-type repositories.
     *
     * @return ProjectConfiguration The project configuration.
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * Get the hook scripts for the package.
     *
     * @return ScriptConfiguration The hook scripts.
     */
    public function scripts()
    {
        return $this->scripts;
    }

    /**
     * Get the arbitrary extra data contained in the project's configuration.
     *
     * @return mixed The extra data.
     */
    public function extra()
    {
        return $this->extra;
    }

    /**
     * Get the binary executable files provided by the package.
     *
     * @return array<integer,string> The executable files.
     */
    public function bin()
    {
        return $this->bin;
    }

    /**
     * Get the archive configuration for the package.
     *
     * @return ArchiveConfiguration The archive configuration.
     */
    public function archive()
    {
        return $this->archive;
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

    private $name;
    private $description;
    private $version;
    private $type;
    private $keywords;
    private $homepage;
    private $time;
    private $license;
    private $authors;
    private $support;
    private $dependencies;
    private $devDependencies;
    private $conflict;
    private $replace;
    private $provide;
    private $suggest;
    private $autoloadPsr4;
    private $autoloadPsr0;
    private $autoloadClassmap;
    private $autoloadFiles;
    private $includePath;
    private $targetDir;
    private $minimumStability;
    private $preferStable;
    private $repositories;
    private $config;
    private $scripts;
    private $extra;
    private $bin;
    private $archive;
    private $rawData;
}
