<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2014 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use Phake;
use PHPUnit_Framework_TestCase;
use ReflectionObject;

class ProjectConfigurationTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $config = new ProjectConfiguration(
            111,
            true,
            InstallationMethod::DIST(),
            array('ftp', 'otp'),
            array('hostA' => 'tokenA', 'hostB' => 'tokenB'),
            'vendorDir',
            'binDir',
            'cacheDir',
            'cacheFilesDir',
            'cacheRepoDir',
            'cacheVcsDir',
            222,
            333,
            false,
            'autoloaderSuffix',
            true,
            array('hostC', 'hostD'),
            false,
            VcsChangePolicy::STASH(),
            'rawData'
        );

        $this->assertSame(111, $config->processTimeout());
        $this->assertTrue($config->useIncludePath());
        $this->assertSame(InstallationMethod::DIST(), $config->preferredInstall());
        $this->assertSame(array('ftp', 'otp'), $config->githubProtocols());
        $this->assertSame(array('hostA' => 'tokenA', 'hostB' => 'tokenB'), $config->githubOauth());
        $this->assertSame('vendorDir', $config->vendorDir());
        $this->assertSame('binDir', $config->binDir());
        $this->assertSame('cacheDir', $config->cacheDir());
        $this->assertSame('cacheFilesDir', $config->cacheFilesDir());
        $this->assertSame('cacheRepoDir', $config->cacheRepoDir());
        $this->assertSame('cacheVcsDir', $config->cacheVcsDir());
        $this->assertSame(222, $config->cacheFilesTtl());
        $this->assertSame(333, $config->cacheFilesMaxsize());
        $this->assertFalse($config->prependAutoloader());
        $this->assertSame('autoloaderSuffix', $config->autoloaderSuffix());
        $this->assertTrue($config->optimizeAutoloader());
        $this->assertSame(array('hostC', 'hostD'), $config->githubDomains());
        $this->assertFalse($config->notifyOnInstall());
        $this->assertSame(VcsChangePolicy::STASH(), $config->discardChanges());
        $this->assertSame('rawData', $config->rawData());
    }

    public function testConstructorDefaults()
    {
        $isolator = Phake::mock('Icecave\Isolator\Isolator');
        Phake::when($isolator)->getenv('COMPOSER_CACHE_DIR')->thenReturn('/path/to/composer/cache');
        $config = new ProjectConfiguration(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            $isolator
        );

        $this->assertSame(300, $config->processTimeout());
        $this->assertFalse($config->useIncludePath());
        $this->assertSame(InstallationMethod::AUTO(), $config->preferredInstall());
        $this->assertSame(array('git', 'https'), $config->githubProtocols());
        $this->assertSame(array(), $config->githubOauth());
        $this->assertSame('vendor', $config->vendorDir());
        $this->assertSame('vendor/bin', $config->binDir());
        $this->assertSame('/path/to/composer/cache', $config->cacheDir());
        $this->assertSame('/path/to/composer/cache/files', $config->cacheFilesDir());
        $this->assertSame('/path/to/composer/cache/repo', $config->cacheRepoDir());
        $this->assertSame('/path/to/composer/cache/vcs', $config->cacheVcsDir());
        $this->assertSame(6 * 30 * 24 * 60 * 60, $config->cacheFilesTtl());
        $this->assertSame(300 * 1024 * 1024, $config->cacheFilesMaxsize());
        $this->assertTrue($config->prependAutoloader());
        $this->assertNull($config->autoloaderSuffix());
        $this->assertFalse($config->optimizeAutoloader());
        $this->assertSame(array('github.com'), $config->githubDomains());
        $this->assertTrue($config->notifyOnInstall());
        $this->assertSame(VcsChangePolicy::IGNORE(), $config->discardChanges());
        $this->assertNull($config->rawData());
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
        $isolator = Phake::mock('Icecave\Isolator\Isolator');
        foreach ($environment as $name => $value) {
            Phake::when($isolator)->getenv($name)->thenReturn($value);
        }
        foreach ($constants as $name => $value) {
            Phake::when($isolator)->defined($name)->thenReturn(true);
        }
        $config = new ProjectConfiguration(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            $isolator
        );

        if (null === $expected) {
            $this->assertNull($config->cacheDir());
            $this->assertNull($config->cacheFilesDir());
            $this->assertNull($config->cacheRepoDir());
            $this->assertNull($config->cacheVcsDir());
        } else {
            $this->assertSame($expected, $config->cacheDir());
            $this->assertSame($expected . '/files', $config->cacheFilesDir());
            $this->assertSame($expected . '/repo', $config->cacheRepoDir());
            $this->assertSame($expected . '/vcs', $config->cacheVcsDir());
        }
    }

    public function testNoPublicMembers()
    {
        $isolator = Phake::mock('Icecave\Isolator\Isolator');
        $config = new ProjectConfiguration(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            $isolator
        );
        $reflector = new ReflectionObject($config);
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }
}
