<?php

namespace Eloquent\Composer\Configuration;

use Eloquent\Composer\Configuration\Exception\ConfigurationReadException;
use Eloquent\Composer\Configuration\Exception\InvalidJSONException;
use Eloquent\Phony\Phpunit\Phony;
use PHPUnit\Framework\TestCase;
use ReflectionObject;

class ConfigurationReaderTest extends TestCase
{
    protected function setUp(): void
    {

        $this->defined = Phony::stubGlobal('defined', __NAMESPACE__);
        $this->fileGetContents = Phony::stubGlobal('file_get_contents', __NAMESPACE__)->forwards();
        $this->getenv = Phony::stubGlobal('getenv', __NAMESPACE__);

        $this->validator = new ConfigurationValidator();
        $this->reader = new ConfigurationReader($this->validator);
    }

    protected function tearDown(): void
    {
        Phony::restoreGlobalFunctions();
    }

    public function testConstructor()
    {
        $this->assertSame($this->validator, $this->reader->validator());
    }

    public function testConstructorDefaults()
    {
        $reader = new ConfigurationReader();

        $this->assertInstanceOf(__NAMESPACE__ . '\ConfigurationValidator', $reader->validator());
    }

    public function readData()
    {
        $data = [];

        foreach (scandir(__DIR__ . '/../fixture') as $entry) {
            if ('.' === $entry || '..' === $entry) {
                continue;
            }

            $data[$entry] = [$entry];
        }

        return $data;
    }

    /**
     * @dataProvider readData
     */
    public function testRead($name)
    {
        $jsonData = \file_get_contents(__DIR__ . "/../fixture/$name/composer.json");
        $rawData = json_decode($jsonData);
        $expected = require __DIR__ . "/../fixture/$name/expected.php";
        $this->fileGetContents->with('/path/to/configuration')->returns($jsonData);
        $this->getenv->with('COMPOSER_CACHE_DIR')->returns('/path/to/composer/cache');

        $this->assertEquals($expected, $this->reader->read('/path/to/configuration'));
    }

    public function testReadFailureFilesystem()
    {
        $this->fileGetContents->returns(false);

        $this->expectException(ConfigurationReadException::class);
        $this->reader->read('/path/to/configuration');
    }

    public function testReadFailureInvalidJSON()
    {
        $this->fileGetContents->returns('{');

        $this->expectException(InvalidJSONException::class);
        $this->reader->read('/path/to/configuration');
    }

    public function testReadReal()
    {
        $this->fileGetContents->forwards();
        $this->getenv->with('COMPOSER_CACHE_DIR')->returns('/path/to/composer/cache');
        $path = __DIR__ . '/../../composer.json';
        $rawData = json_decode(file_get_contents($path));
        $expected = new Element\Configuration(
            'eloquent/composer-config-reader',
            'A light-weight component for reading Composer configuration files.',
            null,
            null,
            ['composer', 'configuration', 'reader', 'parser'],
            'https://github.com/eloquent/composer-config-reader',
            null,
            ['MIT'],
            [
                new Element\Author(
                    'Erin Millard',
                    'ezzatron@gmail.com',
                    'http://ezzatron.com/',
                    null,
                    $rawData->authors[0]
                ),
            ],
            null,
            [
                'php' => '>=7.2',
                'composer/composer' => '^2',
                'eloquent/enumeration' => '^6',
                'justinrainbow/json-schema' => '^5',
            ],
            [
                'eloquent/code-style' => '^1',
                'eloquent/phony-phpunit' => '^6',
                'friendsofphp/php-cs-fixer' => '^2',
                'phpunit/phpunit' => '^8',
            ],
            null,
            null,
            null,
            null,
            [
                'Eloquent\Composer\Configuration\\' => ['src'],
            ],
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            new Element\ProjectConfiguration(
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                '/path/to/composer/cache',
                '/path/to/composer/cache/files',
                '/path/to/composer/cache/repo',
                '/path/to/composer/cache/vcs'
            ),
            null,
            (object) [
                'branch-alias' => (object) [
                    'dev-master' => '3.0.x-dev',
                ],
            ],
            null,
            null,
            $rawData
        );

        $this->assertEquals($expected, $this->reader->read($path));
    }

    public function defaultCacheDirData()
    {
        return [
            'COMPOSER_CACHE_DIR set' => [
                [
                    'COMPOSER_CACHE_DIR' => '/path/to/composer/cache',
                ],
                [],
                '/path/to/composer/cache',
            ],

            'COMPOSER_HOME set, non-Windows' => [
                [
                    'COMPOSER_HOME' => '/path/to/composer/home',
                ],
                [],
                '/path/to/composer/home/cache',
            ],

            'COMPOSER_HOME set, Windows, LOCALAPPDATA set' => [
                [
                    'COMPOSER_HOME' => 'C:\path\to\composer\home',
                    'LOCALAPPDATA' => 'C:\path\to\localappdata',
                ],
                [
                    'PHP_WINDOWS_VERSION_MAJOR' => 5,
                ],
                'C:/path/to/localappdata/Composer',
            ],

            'COMPOSER_HOME set, Windows, LOCALAPPDATA not set' => [
                [
                    'COMPOSER_HOME' => 'C:\path\to\composer\home',
                ],
                [
                    'PHP_WINDOWS_VERSION_MAJOR' => 5,
                ],
                'C:/path/to/composer/home/cache',
            ],

            'HOME set, non-Windows' => [
                [
                    'HOME' => '/path/to/home/',
                ],
                [],
                '/path/to/home/.composer/cache',
            ],

            'APPDATA set, Windows' => [
                [
                    'APPDATA' => 'C:\path\to\appdata',
                ],
                [
                    'PHP_WINDOWS_VERSION_MAJOR' => 5,
                ],
                'C:/path/to/appdata/Composer/cache',
            ],

            'No environment variables set' => [
                [],
                [],
                null,
            ],
        ];
    }

    /**
     * @dataProvider defaultCacheDirData
     */
    public function testDefaultCacheDir(array $environment, array $constants, $expected)
    {
        foreach ($environment as $name => $value) {
            $this->getenv->with($name)->returns($value);
        }

        foreach ($constants as $name => $value) {
            $this->defined->with($name)->returns(true);
        }

        $readerObject = new ReflectionObject($this->reader);
        $defaultCacheDirMethod = $readerObject->getMethod('defaultCacheDir');
        $defaultCacheDirMethod->setAccessible(true);

        $this->assertSame($expected, $defaultCacheDirMethod->invoke($this->reader));
    }
}
