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

use DateTime;

class Configuration
{
    const NAME_SEPARATOR = '/';

    /**
      * @param string|null $name
      * @param string|null $description
      * @param string|null $version
      * @param string|null $type
      * @param array<string>|null $keywords
      * @param string|null $homepage
      * @param DateTime|null $time
      * @param array<string>|null $license
      * @param array<Author>|null $authors
      * @param SupportInformation|null $support
      * @param array<string,string>|null $dependencies
      * @param array<string,string>|null $devDependencies
      * @param array<string,string>|null $conflict
      * @param array<string,string>|null $replace
      * @param array<string,string>|null $provide
      * @param array<string,string>|null $suggest
      * @param array<string,array<string>>|null $autoloadPSR0
      * @param array<string>|null $autoloadClassmap
      * @param array<string>|null $autoloadFiles
      * @param array<string>|null $includePath
      * @param string|null $targetDir
      * @param Stability|null $minimumStability
      * @param array<AbstractRepository> $repositories
      * @param ProjectConfiguration|null $config
      * @param ScriptConfiguration|null $scripts
      * @param mixed $extra
      * @param array<string> $bin
      * @param mixed $rawData
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
        array $autoloadPSR0 = null,
        array $autoloadClassmap = null,
        array $autoloadFiles = null,
        array $includePath = null,
        $targetDir = null,
        Stability $minimumStability = null,
        array $repositories = null,
        ProjectConfiguration $config = null,
        ScriptConfiguration $scripts = null,
        $extra = null,
        array $bin = null,
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
            $support = new SupportInformation;
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
        if (null === $autoloadPSR0) {
            $autoloadPSR0 = array();
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
        if (null === $repositories) {
            $repositories = array();
        }
        if (null === $config) {
            $config = new ProjectConfiguration;
        }
        if (null === $scripts) {
            $scripts = new ScriptConfiguration;
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
        $this->autoloadPSR0 = $autoloadPSR0;
        $this->autoloadClassmap = $autoloadClassmap;
        $this->autoloadFiles = $autoloadFiles;
        $this->includePath = $includePath;
        $this->targetDir = $targetDir;
        $this->minimumStability = $minimumStability;
        $this->repositories = $repositories;
        $this->config = $config;
        $this->scripts = $scripts;
        $this->extra = $extra;
        $this->bin = $bin;
        $this->rawData = $rawData;
    }

    /**
     * @return string|null
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string|null
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
     * @return string|null
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
     * @return string|null
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function version()
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return array<string>
     */
    public function keywords()
    {
        return $this->keywords;
    }

    /**
     * @return string|null
     */
    public function homepage()
    {
        return $this->homepage;
    }

    /**
     * @return DateTime|null
     */
    public function time()
    {
        return $this->time;
    }

    /**
     * @return array<string>|null
     */
    public function license()
    {
        return $this->license;
    }

    /**
     * @return array<Author>
     */
    public function authors()
    {
        return $this->authors;
    }

    /**
     * @return SupportInformation
     */
    public function support()
    {
        return $this->support;
    }

    /**
     * @return array<string,string>
     */
    public function dependencies()
    {
        return $this->dependencies;
    }

    /**
     * @return array<string,string>
     */
    public function devDependencies()
    {
        return $this->devDependencies;
    }

    /**
     * @return array<string,string>
     */
    public function allDependencies()
    {
        return array_merge(
            $this->dependencies(),
            $this->devDependencies()
        );
    }

    /**
     * @return array<string,string>
     */
    public function conflict()
    {
        return $this->conflict;
    }

    /**
     * @return array<string,string>
     */
    public function replace()
    {
        return $this->replace;
    }

    /**
     * @return array<string,string>
     */
    public function provide()
    {
        return $this->provide;
    }

    /**
     * @return array<string,string>
     */
    public function suggest()
    {
        return $this->suggest;
    }

    /**
     * @return array<string,array<string>>
     */
    public function autoloadPSR0()
    {
        return $this->autoloadPSR0;
    }

    /**
     * @return array<string>
     */
    public function autoloadClassmap()
    {
        return $this->autoloadClassmap;
    }

    /**
     * @return array<string>
     */
    public function autoloadFiles()
    {
        return $this->autoloadFiles;
    }

    /**
     * @return array<string>
     */
    public function includePath()
    {
        return $this->includePath;
    }

    /**
     * @return array<string>
     */
    public function allPSR0SourcePaths()
    {
        $autoloadPSR0Paths = array();
        foreach ($this->autoloadPSR0() as $namespace => $paths) {
          $autoloadPSR0Paths = array_merge($autoloadPSR0Paths, $paths);
        }

        return $autoloadPSR0Paths;
    }

    /**
     * @return array<string>
     */
    public function allSourcePaths()
    {
        return array_merge(
            $this->allPSR0SourcePaths(),
            $this->autoloadClassmap(),
            $this->autoloadFiles(),
            $this->includePath()
        );
    }

    /**
     * @return string|null
     */
    public function targetDir()
    {
        return $this->targetDir;
    }

    /**
     * @return Stability
     */
    public function minimumStability()
    {
        return $this->minimumStability;
    }

    /**
     * @return array<AbstractRepository>
     */
    public function repositories()
    {
        return $this->repositories;
    }

    /**
     * @return ProjectConfiguration
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * @return ScriptConfiguration
     */
    public function scripts()
    {
        return $this->scripts;
    }

    /**
     * @return mixed
     */
    public function extra()
    {
        return $this->extra;
    }

    /**
     * @return array<string>
     */
    public function bin()
    {
        return $this->bin;
    }

    /**
     * @return mixed
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
    private $autoloadPSR0;
    private $autoloadClassmap;
    private $autoloadFiles;
    private $includePath;
    private $targetDir;
    private $minimumStability;
    private $repositories;
    private $config;
    private $scripts;
    private $extra;
    private $bin;
    private $rawData;
}
