<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

use Eloquent\Liberator\Liberator;
use Phake;
use PHPUnit_Framework_TestCase;

class ConfigurationReaderTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->validator = new ConfigurationValidator();
        $this->isolator = Phake::mock('Icecave\Isolator\Isolator');
        $this->reader = new ConfigurationReader(
            $this->validator,
            $this->isolator
        );
    }

    public function testConstructor()
    {
        $this->assertSame($this->validator, $this->reader->validator());
    }

    public function testConstructorDefaults()
    {
        $reader = new ConfigurationReader();

        $this->assertInstanceOf(
            __NAMESPACE__ . '\ConfigurationValidator',
            $reader->validator()
        );
    }

    public function readData()
    {
        $data = array();

        foreach (scandir(__DIR__ . '/../fixture') as $entry) {
            if ('.' === $entry || '..' === $entry) {
                continue;
            }

            $data[$entry] = array($entry);
        }

        return $data;
    }

    /**
     * @dataProvider readData
     */
    public function testRead($name)
    {
        $jsonData = file_get_contents(__DIR__ . "/../fixture/$name/composer.json");
        $rawData = json_decode($jsonData);
        $expected = require __DIR__ . "/../fixture/$name/expected.php";
        Phake::when($this->isolator)->file_get_contents('/path/to/configuration')->thenReturn($jsonData);
        Phake::when($this->isolator)->getenv('COMPOSER_CACHE_DIR')->thenReturn('/path/to/composer/cache');

        $this->assertEquals($expected, $this->reader->read('/path/to/configuration'));
    }

    public function testReadFailureFilesystem()
    {
        $error = Phake::mock('ErrorException');
        Phake::when($this->isolator)
            ->file_get_contents(Phake::anyParameters())
            ->thenThrow($error);

        $this->setExpectedException(
            __NAMESPACE__ . '\Exception\ConfigurationReadException'
        );
        $this->reader->read('/path/to/configuration');
    }

    public function testReadFailureInvalidJSON()
    {
        Phake::when($this->isolator)
            ->file_get_contents(Phake::anyParameters())
            ->thenReturn('{');

        $this->setExpectedException(
            __NAMESPACE__ . '\Exception\InvalidJSONException'
        );
        $this->reader->read('/path/to/configuration');
    }

    public function testReadReal()
    {
        $this->isolator = Phake::partialMock('Icecave\Isolator\Isolator');
        Phake::when($this->isolator)->getenv('COMPOSER_CACHE_DIR')->thenReturn('/path/to/composer/cache');
        $this->reader = new ConfigurationReader(
            null,
            $this->isolator
        );
        $path = __DIR__ . '/../../composer.json';
        $rawData = json_decode(file_get_contents($path));
        $expected = new Element\Configuration(
            'eloquent/composer-config-reader',
            'A light-weight component for reading Composer configuration files.',
            null,
            null,
            array('composer', 'configuration', 'reader', 'parser'),
            'https://github.com/eloquent/composer-config-reader',
            null,
            array('MIT'),
            array(
                new Element\Author(
                    'Erin Millard',
                    'ezzatron@gmail.com',
                    'http://ezzatron.com/',
                    null,
                    $rawData->authors[0]
                ),
            ),
            null,
            array(
                'php' => '>=5.3',
                'eloquent/enumeration' => '^5',
                'icecave/isolator' => '^3',
                'justinrainbow/json-schema' => '^4',
            ),
            array(
                'eloquent/liberator' => '^2',
                'phake/phake' => '^2',
                'phpunit/phpunit' => '^4',
            ),
            null,
            null,
            null,
            null,
            array(
                'Eloquent\Composer\Configuration\\' => array('src'),
            ),
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
                '/path/to/composer/cache/vcs',
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                $rawData->config
            ),
            null,
            null,
            null,
            null,
            $rawData
        );

        $this->assertEquals($expected, $this->reader->read($path));
    }

    public function defaultCacheDirData()
    {
        return array(
            'COMPOSER_CACHE_DIR set' => array(
                array(
                    'COMPOSER_CACHE_DIR' => '/path/to/composer/cache',
                ),
                array(),
                '/path/to/composer/cache',
            ),

            'COMPOSER_HOME set, non-Windows' => array(
                array(
                    'COMPOSER_HOME' => '/path/to/composer/home',
                ),
                array(),
                '/path/to/composer/home/cache',
            ),

            'COMPOSER_HOME set, Windows, LOCALAPPDATA set' => array(
                array(
                    'COMPOSER_HOME' => 'C:\path\to\composer\home',
                    'LOCALAPPDATA' => 'C:\path\to\localappdata',
                ),
                array(
                    'PHP_WINDOWS_VERSION_MAJOR' => 5,
                ),
                'C:/path/to/localappdata/Composer',
            ),

            'COMPOSER_HOME set, Windows, LOCALAPPDATA not set' => array(
                array(
                    'COMPOSER_HOME' => 'C:\path\to\composer\home',
                ),
                array(
                    'PHP_WINDOWS_VERSION_MAJOR' => 5,
                ),
                'C:/path/to/composer/home/cache',
            ),

            'HOME set, non-Windows' => array(
                array(
                    'HOME' => '/path/to/home/',
                ),
                array(),
                '/path/to/home/.composer/cache',
            ),

            'APPDATA set, Windows' => array(
                array(
                    'APPDATA' => 'C:\path\to\appdata',
                ),
                array(
                    'PHP_WINDOWS_VERSION_MAJOR' => 5,
                ),
                'C:/path/to/appdata/Composer/cache',
            ),

            'No environment variables set' => array(
                array(),
                array(),
                null,
            ),
        );
    }

    /**
     * @dataProvider defaultCacheDirData
     */
    public function testDefaultCacheDir(array $environment, array $constants, $expected)
    {
        foreach ($environment as $name => $value) {
            Phake::when($this->isolator)->getenv($name)->thenReturn($value);
        }
        foreach ($constants as $name => $value) {
            Phake::when($this->isolator)->defined($name)->thenReturn(true);
        }

        $this->assertSame($expected, Liberator::liberate($this->reader)->defaultCacheDir());
    }
}
