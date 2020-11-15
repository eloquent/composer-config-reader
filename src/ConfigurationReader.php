<?php

namespace Eloquent\Composer\Configuration;

use DateTime;
use Eloquent\Composer\Configuration\Element\ArchiveConfiguration;
use Eloquent\Composer\Configuration\Element\Author;
use Eloquent\Composer\Configuration\Element\Configuration;
use Eloquent\Composer\Configuration\Element\InstallationMethod;
use Eloquent\Composer\Configuration\Element\PackageRepository;
use Eloquent\Composer\Configuration\Element\PackagistRepository;
use Eloquent\Composer\Configuration\Element\ProjectConfiguration;
use Eloquent\Composer\Configuration\Element\Repository;
use Eloquent\Composer\Configuration\Element\ScriptConfiguration;
use Eloquent\Composer\Configuration\Element\Stability;
use Eloquent\Composer\Configuration\Element\SupportInformation;
use Eloquent\Composer\Configuration\Element\VcsChangePolicy;
use Eloquent\Composer\Configuration\Exception\ConfigurationExceptionInterface;
use Eloquent\Composer\Configuration\Exception\ConfigurationReadException;
use Eloquent\Composer\Configuration\Exception\InvalidJsonException;
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
     */
    public function __construct(ConfigurationValidator $validator = null)
    {
        if (null === $validator) {
            $validator = new ConfigurationValidator();
        }

        $this->validator = $validator;
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
     * @return Configuration                   The parsed configuration.
     * @throws ConfigurationExceptionInterface If there is a problem reading the configuration.
     */
    public function read($path)
    {
        $data = $this->readJson($path);
        $this->validator()->validate($data);

        return $this->createConfiguration($data);
    }

    /**
     * Read JSON data from the supplied path.
     *
     * @param string $path The path to read from.
     *
     * @return ObjectAccess                    The parsed data.
     * @throws ConfigurationExceptionInterface If there is a problem reading the data.
     */
    protected function readJson($path)
    {
        $jsonData = @file_get_contents($path);

        if (false === $jsonData) {
            throw new ConfigurationReadException($path);
        }

        $data = json_decode($jsonData);
        $jsonError = json_last_error();
        if (JSON_ERROR_NONE !== $jsonError) {
            throw new InvalidJsonException($path, $jsonError);
        }

        return new ObjectAccess($data);
    }

    /**
     * Create a configuration object from the supplied JSON data.
     *
     * @param ObjectAccess $data The parsed JSON data.
     *
     * @return Configuration The newly created configuration object.
     */
    protected function createConfiguration(ObjectAccess $data)
    {
        $autoloadData = new ObjectAccess(
            $data->getDefault('autoload', (object) [])
        );

        return new Configuration(
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
            $this->createAutoloadPsr($autoloadData->getDefault('psr-4')),
            $this->createAutoloadPsr($autoloadData->getDefault('psr-0')),
            $autoloadData->getDefault('classmap'),
            $autoloadData->getDefault('files'),
            $data->getDefault('include-path'),
            $data->getDefault('target-dir'),
            $this->createStability($data->getDefault('minimum-stability')),
            $data->getDefault('prefer-stable'),
            $this->createRepositories((array) $data->getDefault('repositories')),
            $this->createProjectConfiguration($data->getDefault('config')),
            $this->createScripts($data->getDefault('scripts')),
            $data->getDefault('extra'),
            $data->getDefault('bin'),
            $this->createArchiveConfiguration($data->getDefault('archive')),
            $data->data()
        );
    }

    /**
     * Create a time from the suppled raw value.
     *
     * @param string|null $time The raw time data.
     *
     * @return DateTime|null The newly created time object.
     */
    protected function createTime($time)
    {
        if (null !== $time) {
            $time = new DateTime($time);
        }

        return $time;
    }

    /**
     * Create an author list from the supplied raw value.
     *
     * @param array|null $authors The raw author list data.
     *
     * @return array<integer,Author>|null The newly created author list.
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
     * Create an author from the supplied raw value.
     *
     * @param ObjectAccess $author The raw author data.
     *
     * @return Author The newly created author.
     */
    protected function createAuthor(ObjectAccess $author)
    {
        return new Author(
            $author->get('name'),
            $author->getDefault('email'),
            $author->getDefault('homepage'),
            $author->getDefault('role'),
            $author->data()
        );
    }

    /**
     * Create a support information object from the supplied raw value.
     *
     * @param stdClass|null $support The raw support information.
     *
     * @return SupportInformation|null The newly created support information object.
     */
    protected function createSupport(stdClass $support = null)
    {
        if (null !== $support) {
            $supportData = new ObjectAccess($support);
            $support = new SupportInformation(
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
     * Create PSR-style autoload information from the supplied raw value.
     *
     * This method currently works for both PSR-0 and PSR-4 data.
     *
     * @param stdClass|null $autoloadPsr The raw PSR autoload data.
     *
     * @return array<string,array<integer,string>>|null The newly created PSR autoload information.
     */
    protected function createAutoloadPsr(stdClass $autoloadPsr = null)
    {
        if (null !== $autoloadPsr) {
            $autoloadPsr = $this->objectToArray($autoloadPsr);
            foreach ($autoloadPsr as $namespace => $paths) {
                $autoloadPsr[$namespace] = $this->arrayize($paths);
            }
        }

        return $autoloadPsr;
    }

    /**
     * Create a stability enumeration from the supplied raw data.
     *
     * @param string|null $stability The raw stability data.
     *
     * @return Stability|null The newly created stability enumeration.
     */
    protected function createStability($stability)
    {
        if (null !== $stability) {
            $stability = Stability::memberByValue($stability, false);
        }

        return $stability;
    }

    /**
     * Create a repository list from the supplied raw value.
     *
     * @param array|null $repositories The raw repository list data.
     *
     * @return array<integer,RepositoryInterface>|null The newly created repository list.
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
     * Create a repository from the supplied raw value.
     *
     * @param ObjectAccess $repository The raw repository data.
     *
     * @return RepositoryInterface The newly created repository.
     */
    protected function createRepository(ObjectAccess $repository)
    {
        if ($repository->exists('packagist')) {
            return new PackagistRepository(
                $repository->get('packagist'),
                $repository->data()
            );
        }

        $type = $repository->get('type');

        if ('package' === $type) {
            $repository = new PackageRepository(
                $this->objectToArray($repository->get('package')),
                $this->objectToArray($repository->getDefault('options')),
                $repository->data()
            );
        } else {
            $repository = new Repository(
                $type,
                $repository->getDefault('url'),
                $this->objectToArray($repository->getDefault('options')),
                $repository->data()
            );
        }

        return $repository;
    }

    /**
     * Create a project configuration object from the supplied raw value.
     *
     * @param stdClass|null $config The raw project configuration data.
     *
     * @return ProjectConfiguration The newly created project configuration object.
     */
    protected function createProjectConfiguration(stdClass $config = null)
    {
        if (null === $config) {
            return new ProjectConfiguration(
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                $this->defaultCacheDir()
            );
        }

        $configData = new ObjectAccess($config);

        $cacheDir = $configData->getDefault('cache-dir');
        if (null === $cacheDir) {
            $cacheDir = $this->defaultCacheDir();
        }

        return new ProjectConfiguration(
            $configData->getDefault('process-timeout'),
            $configData->getDefault('use-include-path'),
            $this->createInstallationMethod(
                $configData->getDefault('preferred-install')
            ),
            $configData->getDefault('github-protocols'),
            $this->objectToArray($configData->getDefault('github-oauth')),
            $configData->getDefault('vendor-dir'),
            $configData->getDefault('bin-dir'),
            $cacheDir,
            $configData->getDefault('cache-files-dir'),
            $configData->getDefault('cache-repo-dir'),
            $configData->getDefault('cache-vcs-dir'),
            $configData->getDefault('cache-files-ttl'),
            $configData->getDefault('cache-files-maxsize'),
            $configData->getDefault('prepend-autoloader'),
            $configData->getDefault('autoloader-suffix'),
            $configData->getDefault('optimize-autoloader'),
            $configData->getDefault('github-domains'),
            $configData->getDefault('notify-on-install'),
            $this->createVcsChangePolicy(
                $configData->getDefault('discard-changes')
            ),
            $configData->data()
        );
    }

    /**
     * Get the default cache directory for the current environment.
     *
     * @return string|null The default cache directory, or null if the cache directory could not be determined.
     */
    protected function defaultCacheDir()
    {
        $cacheDir = getenv('COMPOSER_CACHE_DIR');
        if ($cacheDir) {
            return $cacheDir;
        }

        $home = getenv('COMPOSER_HOME');
        $isWindows = defined('PHP_WINDOWS_VERSION_MAJOR');

        if (!$home) {
            if ($isWindows) {
                if ($envAppData = getenv('APPDATA')) {
                    $home = strtr($envAppData, '\\', '/') . '/Composer';
                }
            } elseif ($envHome = getenv('HOME')) {
                $home = rtrim($envHome, '/') . '/.composer';
            }
        }

        if ($home && !$cacheDir) {
            if ($isWindows) {
                if ($cacheDir = getenv('LOCALAPPDATA')) {
                    $cacheDir .= '/Composer';
                } else {
                    $cacheDir = $home . '/cache';
                }

                $cacheDir = strtr($cacheDir, '\\', '/');
            } else {
                $cacheDir = $home . '/cache';
            }
        }

        if (!$cacheDir) {
            return null;
        }

        return $cacheDir;
    }

    /**
     * Create a installation method enumeration from the supplied raw data.
     *
     * @param string|stdClass|null $method The raw installation method data.
     *
     * @return InstallationMethod|array<string,InstallationMethod>|null The processed installation method.
     */
    protected function createInstallationMethod($method)
    {
        if (is_string($method)) {
            return InstallationMethod::memberByValue($method, false);
        }

        if (is_object($method)) {
            $methods = [];

            foreach ($method as $project => $projectMethod) {
                $methods[$project] =
                    InstallationMethod::memberByValue($projectMethod, false);
            }

            return $methods;
        }

        return null;
    }

    /**
     * Create a VCS change policy enumeration from the supplied raw data.
     *
     * @param string|null $policy The raw VCS change policy data.
     *
     * @return VcsChangePolicy|null The newly created VCS change policy enumeration.
     */
    protected function createVcsChangePolicy($policy)
    {
        if (null !== $policy) {
            $policy = VcsChangePolicy::memberByValue($policy, false);
        }

        return $policy;
    }

    /**
     * Create a script configuration object from the supplied raw value.
     *
     * @param stdClass|null $scripts The raw script configuration data.
     *
     * @return ScriptConfiguration|null The newly created script configuration object.
     */
    protected function createScripts(stdClass $scripts = null)
    {
        if (null !== $scripts) {
            $scriptsData = new ObjectAccess($scripts);
            $scripts = new ScriptConfiguration(
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
     * Create an archive configuration object from the supplied raw value.
     *
     * @param stdClass|null $archive The raw archive configuration data.
     *
     * @return ArchiveConfiguration|null The newly created archive configuration object.
     */
    protected function createArchiveConfiguration(stdClass $archive = null)
    {
        if (null !== $archive) {
            $archiveData = new ObjectAccess($archive);
            $archive = new ArchiveConfiguration(
                $archiveData->getDefault('exclude'),
                $archiveData->data()
            );
        }

        return $archive;
    }

    /**
     * Recursively convert the supplied object to an associative array.
     *
     * @param stdClass|null $data The object to convert.
     *
     * @return array<string,mixed> The converted associative array.
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
     * Normalize singular values into an array containing the initial value as
     * a single element.
     *
     * @param mixed $data The data to normalize.
     *
     * @return array The normalized value.
     */
    protected function arrayize($data)
    {
        if (null !== $data && !is_array($data)) {
            $data = [$data];
        }

        return $data;
    }

    private $validator;
}
