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

use DateTime;

class Configuration
{
    /**
      * @param string|null $name
      * @param string|null $description
      * @param string|null $version
      * @param string $type
      * @param array<string> $keywords
      * @param string|null $homepage
      * @param DateTime|null $time
      * @param string|null $license
      * @param array<Author> $authors
      * @param SupportInformation|null $support
      * @param array<string,string> $dependencies
      * @param array<string,string> $devDependencies
      * @param array<string,string> $conflict
      * @param array<string,string> $replace
      * @param array<string,string> $provide
      * @param array<string,string> $suggest
      * @param array<string,string> $autoloadPSR0
      * @param array<string> $autoloadClassmap
      * @param array<string> $autoloadFiles
      * @param array<string> $includePath
      * @param string|null $targetDir
      * @param Stability|null $minimumStability
      * @param array<Repository> $repositories
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
        $type = 'library',
        array $keywords = array(),
        $homepage = null,
        DateTime $time = null,
        $license = null,
        array $authors = array(),
        SupportInformation $support = null,
        array $dependencies = array(),
        array $devDependencies = array(),
        array $conflict = array(),
        array $replace = array(),
        array $provide = array(),
        array $suggest = array(),
        array $autoloadPSR0 = array(),
        array $autoloadClassmap = array(),
        array $autoloadFiles = array(),
        array $includePath = array(),
        $targetDir = null,
        Stability $minimumStability = null,
        array $repositories = array(),
        ProjectConfiguration $config = null,
        ScriptConfiguration $scripts = null,
        $extra = null,
        array $bin = array(),
        $rawData = null
    ) {
        if (null === $support) {
            $support = new SupportInformation;
        }
        if (null === $minimumStability) {
            $minimumStability = Stability::STABLE();
        }
        if (null === $config) {
            $config = new ProjectConfiguration;
        }
        if (null === $scripts) {
            $scripts = new ScriptConfiguration;
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
     * @return string|null
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
     * @return array<string,string>
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
    public function allSourcePaths()
    {
        return array_merge(
            array_values($this->autoloadPSR0()),
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
     * @return array<Repository>
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
