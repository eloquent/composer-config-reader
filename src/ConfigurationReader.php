<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

use DateTime;
use ErrorException;
use Icecave\Isolator\Isolator;
use stdClass;

/**
 * Reads Composer configuration data.
 */
class ConfigurationReader
{
    /**
     * Construct a new configuration reader.
     *
     * @param ConfigurationValidator|null $validator The validator to use.
     * @param Isolator|null               $isolator  The isolator to use.
     */
    public function __construct(
        ConfigurationValidator $validator = null,
        Isolator $isolator = null
    ) {
        if (null === $validator) {
            $validator = new ConfigurationValidator;
        }

        $this->validator = $validator;
        $this->isolator = Isolator::get($isolator);
    }

    /**
     * Get the configuration validator.
     *
     * @return ConfigurationValidator The configuration validator.
     */
    public function validator()
    {
        return $this->validator;
    }

    /**
     * Read a Composer configuration file.
     *
     * @param string $path The configuration file path.
     *
     * @return Element\Configuration The parsed configuration.
     */
    public function read($path)
    {
        $data = $this->readJson($path);
        $this->validator()->validate($data);

        return $this->createConfiguration($data);
    }

    /**
     * @param string $path
     *
     * @return ObjectAccess
     */
    protected function readJson($path)
    {
        try {
            $jsonData = $this->isolator->file_get_contents($path);
        } catch (ErrorException $e) {
            throw new Exception\ConfigurationReadException($path, $e);
        }

        $data = json_decode($jsonData);
        $jsonError = json_last_error();
        if (JSON_ERROR_NONE !== $jsonError) {
            throw new Exception\InvalidJSONException($path, $jsonError);
        }

        return new ObjectAccess($data);
    }

    /**
     * @param ObjectAccess $data
     *
     * @return Element\Configuration
     */
    protected function createConfiguration(ObjectAccess $data)
    {
        $autoloadData = new ObjectAccess(
            $data->getDefault('autoload', new stdClass)
        );

        return new Element\Configuration(
            $data->getDefault('name'),
            $data->getDefault('description'),
            $data->getDefault('version'),
            $data->getDefault('type'),
            $data->getDefault('keywords'),
            $data->getDefault('homepage'),
            $this->createTime($data->getDefault('time')),
            $this->arrayize($data->getDefault('license')),
            $this->createAuthors($data->getDefault('authors')),
            $this->createSupport($data->getDefault('support')),
            $this->objectToArray($data->getDefault('require')),
            $this->objectToArray($data->getDefault('require-dev')),
            $this->objectToArray($data->getDefault('conflict')),
            $this->objectToArray($data->getDefault('replace')),
            $this->objectToArray($data->getDefault('provide')),
            $this->objectToArray($data->getDefault('suggest')),
            $this->createAutoloadPsr4($autoloadData->getDefault('psr-4')),
            $this->createAutoloadPsr0($autoloadData->getDefault('psr-0')),
            $autoloadData->getDefault('classmap'),
            $autoloadData->getDefault('files'),
            $data->getDefault('include-path'),
            $data->getDefault('target-dir'),
            $this->createMinimumStability($data->getDefault('minimum-stability')),
            $data->getDefault('prefer-stable'),
            $this->createRepositories($data->getDefault('repositories')),
            $this->createProjectConfiguration($data->getDefault('config')),
            $this->createScripts($data->getDefault('scripts')),
            $data->getDefault('extra'),
            $data->getDefault('bin'),
            $this->createArchiveConfiguration($data->getDefault('archive')),
            $data->data()
        );
    }

    /**
     * @param string|null $time
     *
     * @return DateTime|null
     */
    protected function createTime($time)
    {
        if (null !== $time) {
            $time = new DateTime($time);
        }

        return $time;
    }

    /**
     * @param array|null $authors
     *
     * @return array<Element\Author>
     */
    protected function createAuthors(array $authors = null)
    {
        if (null !== $authors) {
            foreach ($authors as $index => $author) {
                $authors[$index] = $this->createAuthor(
                    new ObjectAccess($author)
                );
            }
        }

        return $authors;
    }

    /**
     * @param ObjectAccess $author
     *
     * @return Element\Author
     */
    protected function createAuthor(ObjectAccess $author)
    {
        return new Element\Author(
            $author->get('name'),
            $author->getDefault('email'),
            $author->getDefault('homepage'),
            $author->getDefault('role'),
            $author->data()
        );
    }

    /**
     * @param stdClass|null $support
     *
     * @return Element\SupportInformation
     */
    protected function createSupport(stdClass $support = null)
    {
        if (null !== $support) {
            $supportData = new ObjectAccess($support);
            $support = new Element\SupportInformation(
                $supportData->getDefault('email'),
                $supportData->getDefault('issues'),
                $supportData->getDefault('forum'),
                $supportData->getDefault('wiki'),
                $supportData->getDefault('irc'),
                $supportData->getDefault('source'),
                $supportData->data()
            );
        }

        return $support;
    }

    /**
     * @param stdClass|null $autoloadPsr4
     *
     * @return array
     */
    protected function createAutoloadPsr4(stdClass $autoloadPsr4 = null)
    {
        if (null !== $autoloadPsr4) {
            $autoloadPsr4 = $this->objectToArray($autoloadPsr4);
            foreach ($autoloadPsr4 as $namespace => $paths) {
                $autoloadPsr4[$namespace] = $this->arrayize($paths);
            }
        }

        return $autoloadPsr4;
    }

    /**
     * @param stdClass|null $autoloadPsr0
     *
     * @return array
     */
    protected function createAutoloadPsr0(stdClass $autoloadPsr0 = null)
    {
        if (null !== $autoloadPsr0) {
            $autoloadPsr0 = $this->objectToArray($autoloadPsr0);
            foreach ($autoloadPsr0 as $namespace => $paths) {
                $autoloadPsr0[$namespace] = $this->arrayize($paths);
            }
        }

        return $autoloadPsr0;
    }

    /**
     * @param string|null $stability
     *
     * @return Element\Stability
     */
    protected function createMinimumStability($stability)
    {
        if (null !== $stability) {
            $stability = Element\Stability::memberByValue($stability, false);
        }

        return $stability;
    }

    /**
     * @param array|null $repositories
     *
     * @return array<Element\Author>
     */
    protected function createRepositories(array $repositories = null)
    {
        if (null !== $repositories) {
            foreach ($repositories as $index => $repository) {
                $repositories[$index] = $this->createRepository(
                    new ObjectAccess($repository)
                );
            }
        }

        return $repositories;
    }

    /**
     * @param ObjectAccess $repository
     *
     * @return Element\Repository
     */
    protected function createRepository(ObjectAccess $repository)
    {
        $type = $repository->get('type');
        if ('package' === $type) {
            $repository = new Element\PackageRepository(
                $this->objectToArray($repository->get('package')),
                $this->objectToArray($repository->getDefault('options')),
                $repository->data()
            );
        } else {
            $repository = new Element\Repository(
                $type,
                $repository->getDefault('url'),
                $this->objectToArray($repository->getDefault('options')),
                $repository->data()
            );
        }

        return $repository;
    }

    /**
     * @param stdClass|null $config
     *
     * @return Element\ProjectConfiguration
     */
    protected function createProjectConfiguration(stdClass $config = null)
    {
        if (null !== $config) {
            $configData = new ObjectAccess($config);
            $config = new Element\ProjectConfiguration(
                $configData->getDefault('vendor-dir'),
                $configData->getDefault('bin-dir'),
                $configData->getDefault('process-timeout'),
                $configData->getDefault('notify-on-install'),
                $configData->getDefault('github-protocols'),
                $configData->data()
            );
        }

        return $config;
    }

    /**
     * @param stdClass|null $scripts
     *
     * @return Element\ScriptConfiguration
     */
    protected function createScripts(stdClass $scripts = null)
    {
        if (null !== $scripts) {
            $scriptsData = new ObjectAccess($scripts);
            $scripts = new Element\ScriptConfiguration(
                $this->arrayize($scriptsData->getDefault('pre-install-cmd')),
                $this->arrayize($scriptsData->getDefault('post-install-cmd')),
                $this->arrayize($scriptsData->getDefault('pre-update-cmd')),
                $this->arrayize($scriptsData->getDefault('post-update-cmd')),
                $this->arrayize($scriptsData->getDefault('pre-status-cmd')),
                $this->arrayize($scriptsData->getDefault('post-status-cmd')),
                $this->arrayize($scriptsData->getDefault('pre-package-install')),
                $this->arrayize($scriptsData->getDefault('post-package-install')),
                $this->arrayize($scriptsData->getDefault('pre-package-update')),
                $this->arrayize($scriptsData->getDefault('post-package-update')),
                $this->arrayize($scriptsData->getDefault('pre-package-uninstall')),
                $this->arrayize($scriptsData->getDefault('post-package-uninstall')),
                $this->arrayize($scriptsData->getDefault('pre-autoload-dump')),
                $this->arrayize($scriptsData->getDefault('post-autoload-dump')),
                $this->arrayize($scriptsData->getDefault('post-root-package-install')),
                $this->arrayize($scriptsData->getDefault('post-create-project-cmd')),
                $scriptsData->data()
            );
        }

        return $scripts;
    }

    /**
     * @param stdClass|null $archive
     *
     * @return Element\ArchiveConfiguration
     */
    protected function createArchiveConfiguration(stdClass $archive = null)
    {
        if (null !== $archive) {
            $archiveData = new ObjectAccess($archive);
            $archive = new Element\ArchiveConfiguration(
                $archiveData->getDefault('exclude'),
                $archiveData->data()
            );
        }

        return $archive;
    }

    /**
     * @param stdClass|null $data
     *
     * @return array<string,string>
     */
    protected function objectToArray(stdClass $data = null)
    {
        if (null !== $data) {
            $data = (array) $data;
            foreach ($data as $key => $value) {
                if ($value instanceof stdClass) {
                    $data[$key] = $this->objectToArray($value);
                }
            }
        }

        return $data;
    }

    /**
     * @param mixed $data
     *
     * @return array
     */
    protected function arrayize($data)
    {
        if (
            null !== $data &&
            !is_array($data)
        ) {
            $data = array($data);
        }

        return $data;
    }

    private $validator;
    private $isolator;
}
