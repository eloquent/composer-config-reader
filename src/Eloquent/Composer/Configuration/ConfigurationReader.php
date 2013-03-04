<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

use DateTime;
use ErrorException;
use Icecave\Isolator\Isolator;
use stdClass;

class ConfigurationReader
{
    /**
     * @param ConfigurationValidator|null $validator
     * @param Isolator|null               $isolator
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
     * @return ConfigurationValidator
     */
    public function validator()
    {
        return $this->validator;
    }

    /**
     * @param string $path
     *
     * @return Domain\Configuration
     */
    public function read($path)
    {
        $data = $this->readJSON($path);
        $this->validator()->validate($data);

        return $this->createConfiguration($data);
    }

    /**
     * @param string $path
     *
     * @return ObjectAccess
     */
    protected function readJSON($path)
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
     * @return Domain\Configuration
     */
    protected function createConfiguration(ObjectAccess $data)
    {
        $autoloadData = new ObjectAccess(
            $data->getDefault('autoload', new stdClass)
        );

        return new Domain\Configuration(
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
            $this->createAutoloadPSR0($autoloadData->getDefault('psr-0')),
            $autoloadData->getDefault('classmap'),
            $autoloadData->getDefault('files'),
            $data->getDefault('include-path'),
            $data->getDefault('target-dir'),
            $this->createMinimumStability($data->getDefault('minimum-stability')),
            $this->createRepositories($data->getDefault('repositories')),
            $this->createProjectConfiguration($data->getDefault('config')),
            $this->createScripts($data->getDefault('scripts')),
            $data->getDefault('extra'),
            $data->getDefault('bin'),
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
     * @return array<Domain\Author>
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
     * @return Domain\Author
     */
    protected function createAuthor(ObjectAccess $author)
    {
        return new Domain\Author(
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
     * @return Domain\SupportInformation
     */
    protected function createSupport(stdClass $support = null)
    {
        if (null !== $support) {
            $supportData = new ObjectAccess($support);
            $support = new Domain\SupportInformation(
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
     * @param stdClass|null $autoloadPSR0
     *
     * @return array
     */
    protected function createAutoloadPSR0(stdClass $autoloadPSR0 = null)
    {
        if (null !== $autoloadPSR0) {
            $autoloadPSR0 = $this->objectToArray($autoloadPSR0);
            foreach ($autoloadPSR0 as $namespace => $paths) {
                $autoloadPSR0[$namespace] = $this->arrayize($paths);
            }
        }

        return $autoloadPSR0;
    }

    /**
     * @param string|null $stability
     *
     * @return Domain\Stability
     */
    protected function createMinimumStability($stability)
    {
        if (null !== $stability) {
            $stability = Domain\Stability::instanceByValueIgnoreCase($stability);
        }

        return $stability;
    }

    /**
     * @param array|null $repositories
     *
     * @return array<Domain\Author>
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
     * @return Domain\Repository
     */
    protected function createRepository(ObjectAccess $repository)
    {
        $type = $repository->get('type');
        if ('package' === $type) {
            $repository = new Domain\PackageRepository(
                $this->objectToArray($repository->get('package')),
                $this->objectToArray($repository->getDefault('options')),
                $repository->data()
            );
        } else {
            $repository = new Domain\Repository(
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
     * @return Domain\ProjectConfiguration
     */
    protected function createProjectConfiguration(stdClass $config = null)
    {
        if (null !== $config) {
            $configData = new ObjectAccess($config);
            $config = new Domain\ProjectConfiguration(
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
     * @return Domain\ScriptConfiguration
     */
    protected function createScripts(stdClass $scripts = null)
    {
        if (null !== $scripts) {
            $scriptsData = new ObjectAccess($scripts);
            $scripts = new Domain\ScriptConfiguration(
                $this->arrayize($scriptsData->getDefault('pre-install-cmd')),
                $this->arrayize($scriptsData->getDefault('post-install-cmd')),
                $this->arrayize($scriptsData->getDefault('pre-update-cmd')),
                $this->arrayize($scriptsData->getDefault('post-update-cmd')),
                $this->arrayize($scriptsData->getDefault('pre-package-install')),
                $this->arrayize($scriptsData->getDefault('post-package-install')),
                $this->arrayize($scriptsData->getDefault('pre-package-update')),
                $this->arrayize($scriptsData->getDefault('post-package-update')),
                $this->arrayize($scriptsData->getDefault('pre-package-uninstall')),
                $this->arrayize($scriptsData->getDefault('post-package-uninstall')),
                $scriptsData->data()
            );
        }

        return $scripts;
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
