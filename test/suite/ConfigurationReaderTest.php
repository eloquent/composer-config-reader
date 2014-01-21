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
use Phake;
use PHPUnit_Framework_TestCase;

class ConfigurationReaderTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->validator = new ConfigurationValidator;
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
        $reader = new ConfigurationReader;

        $this->assertInstanceOf(
            __NAMESPACE__.'\ConfigurationValidator',
            $reader->validator()
        );
    }

    public function readData()
    {
        $data = array();

        $json = <<<'EOD'
{}
EOD;
        $rawData = json_decode($json);
        $expected = new Element\Configuration(
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
            $rawData
        );
        $data['Empty configuration'] = array($expected, $json);

        $json = <<<'EOD'
{
    "name": "monolog/monolog",
    "description": "Logging for PHP 5.3",
    "version": "1.1.0",
    "type": "custom-package-type",
    "keywords": ["logging", "events", "database", "redis", "templating"],
    "homepage": "http://example.org/",
    "time": "2011-11-11 11:11:11",
    "license": [
       "LGPL-2.1",
       "GPL-3.0+"
    ],
    "authors": [
        {
            "name": "Nils Adermann",
            "email": "naderman@naderman.de",
            "homepage": "http://www.naderman.de",
            "role": "Developer"
        },
        {
            "name": "Jordi Boggiano",
            "email": "j.boggiano@seld.be",
            "homepage": "http://seld.be",
            "role": "Developer"
        }
    ],
    "support": {
        "email": "support@example.org",
        "issues": "https://github.com/composer/composer/issues",
        "forum": "http://example.org/forum",
        "wiki": "https://github.com/composer/composer/wiki",
        "irc": "irc://irc.freenode.org/composer",
        "source": "https://github.com/composer/composer"
    },
    "require": {
        "monolog/monolog": "1.0.*@beta",
        "acme/foo": "@dev"
    },
    "require-dev": {
        "eloquent/liberator": "1.*",
        "phake/phake": "1.*"
    },
    "conflict": {
        "eloquent/asplode": "*",
        "eloquent/blox": "*"
    },
    "replace": {
        "eloquent/cosmos": "*",
        "eloquent/enumeration": "*"
    },
    "provide": {
        "eloquent/typhax": "*",
        "icecave/visita": "*"
    },
    "suggest": {
        "symfony/console": "*",
        "symfony/filesystem": "*"
    },
    "autoload": {
        "psr-4": {
            "Nermsperce": ["serse", "lerb"],
            "Vernder\\Nermsperce": "serse"
        },
        "psr-0": {
            "Monolog": ["src", "lib"],
            "Vendor\\Namespace": "src"
        },
        "classmap": ["src", "lib", "Something.php"],
        "files": ["src/MyLibrary/init.php", "src/MyLibrary/functions.php"]
    },
    "include-path": ["lib-old", "src-old"],
    "target-dir": "Symfony/Component/Yaml",
    "minimum-stability": "dev",
    "prefer-stable": true,
    "repositories": [
        {
            "type": "composer",
            "url": "http://packages.example.com"
        },
        {
            "type": "composer",
            "url": "https://packages.example.com",
            "options": {
                "ssl": {
                    "verify_peer": true
                }
            }
        },
        {
            "type": "vcs",
            "url": "https://github.com/Seldaek/monolog"
        },
        {
            "type": "pear",
            "url": "http://pear2.php.net"
        },
        {
            "type": "package",
            "package": {
                "name": "smarty/smarty",
                "version": "3.1.7",
                "dist": {
                    "url": "http://www.smarty.net/files/Smarty-3.1.7.zip",
                    "type": "zip"
                },
                "source": {
                    "url": "http://smarty-php.googlecode.com/svn/",
                    "type": "svn",
                    "reference": "tags/Smarty_3_1_7/distribution/"
                }
            }
        }
    ],
    "config": {
        "vendor-dir": "ext",
        "bin-dir": "bin",
        "process-timeout": 111,
        "github-protocols": ["ftp", "otp"],
        "notify-on-install": false
    },
    "scripts": {
        "pre-install-cmd": "MyVendor\\MyClass::preInstall",
        "post-install-cmd": "MyVendor\\MyClass::postInstall",
        "pre-update-cmd": "MyVendor\\MyClass::preUpdate",
        "post-update-cmd": "MyVendor\\MyClass::postUpdate",
        "pre-status-cmd": "MyVendor\\MyClass::preStatus",
        "post-status-cmd": "MyVendor\\MyClass::postStatus",
        "pre-package-install": "MyVendor\\MyClass::prePackageInstall",
        "post-package-install": [
            "MyVendor\\MyClass::postPackageInstall"
        ],
        "pre-package-update": "MyVendor\\MyClass::prePackageUpdate",
        "post-package-update": "MyVendor\\MyClass::postPackageUpdate",
        "pre-package-uninstall": "MyVendor\\MyClass::prePackageUninstall",
        "post-package-uninstall": [
            "MyVendor\\MyClass::postPackageUninstallA",
            "MyVendor\\MyClass::postPackageUninstallB"
        ],
        "pre-autoload-dump": "MyVendor\\MyClass::preAutoloadDump",
        "post-autoload-dump": "MyVendor\\MyClass::postAutoloadDump",
        "post-root-package-install": "MyVendor\\MyClass::postRootPackageInstall",
        "post-create-project-cmd": "MyVendor\\MyClass::postCreateProjectCmd"
    },
    "extra": {"foo": "bar"},
    "bin": ["bin/my-script", "bin/my-other-script"],
    "archive": {
        "exclude": ["patternA", "patternB"]
    }
}
EOD;
        $rawData = json_decode($json);
        $expected = new Element\Configuration(
            'monolog/monolog',
            'Logging for PHP 5.3',
            '1.1.0',
            'custom-package-type',
            array('logging', 'events', 'database', 'redis', 'templating'),
            'http://example.org/',
            new DateTime('2011-11-11 11:11:11'),
            array('LGPL-2.1', 'GPL-3.0+'),
            array(
                new Element\Author(
                    'Nils Adermann',
                    'naderman@naderman.de',
                    'http://www.naderman.de',
                    'Developer',
                    $rawData->authors[0]
                ),
                new Element\Author(
                    'Jordi Boggiano',
                    'j.boggiano@seld.be',
                    'http://seld.be',
                    'Developer',
                    $rawData->authors[1]
                ),
            ),
            new Element\SupportInformation(
                'support@example.org',
                'https://github.com/composer/composer/issues',
                'http://example.org/forum',
                'https://github.com/composer/composer/wiki',
                'irc://irc.freenode.org/composer',
                'https://github.com/composer/composer',
                $rawData->support
            ),
            array(
                'monolog/monolog' => '1.0.*@beta',
                'acme/foo' => '@dev',
            ),
            array(
                'eloquent/liberator' => '1.*',
                'phake/phake' => '1.*',
            ),
            array(
                'eloquent/asplode' => '*',
                'eloquent/blox' => '*',
            ),
            array(
                'eloquent/cosmos' => '*',
                'eloquent/enumeration' => '*',
            ),
            array(
                'eloquent/typhax' => '*',
                'icecave/visita' => '*',
            ),
            array(
                'symfony/console' => '*',
                'symfony/filesystem' => '*',
            ),
            array(
                'Nermsperce' => array('serse', 'lerb'),
                'Vernder\Nermsperce' => array('serse'),
            ),
            array(
                'Monolog' => array('src', 'lib'),
                'Vendor\Namespace' => array('src'),
            ),
            array('src', 'lib', 'Something.php'),
            array('src/MyLibrary/init.php', 'src/MyLibrary/functions.php'),
            array('lib-old', 'src-old'),
            'Symfony/Component/Yaml',
            Element\Stability::DEV(),
            true,
            array(
                new Element\Repository(
                    'composer',
                    'http://packages.example.com',
                    null,
                    $rawData->repositories[0]
                ),
                new Element\Repository(
                    'composer',
                    'https://packages.example.com',
                    array(
                        'ssl' => array(
                            'verify_peer' => true
                        ),
                    ),
                    $rawData->repositories[1]
                ),
                new Element\Repository(
                    'vcs',
                    'https://github.com/Seldaek/monolog',
                    null,
                    $rawData->repositories[2]
                ),
                new Element\Repository(
                    'pear',
                    'http://pear2.php.net',
                    null,
                    $rawData->repositories[3]
                ),
                new Element\PackageRepository(
                    array(
                        'name' => 'smarty/smarty',
                        'version' => '3.1.7',
                        'dist' => array(
                            'url' => 'http://www.smarty.net/files/Smarty-3.1.7.zip',
                            'type' => 'zip',
                        ),
                        'source' => array(
                            'url' => 'http://smarty-php.googlecode.com/svn/',
                            'type' => 'svn',
                            'reference' => 'tags/Smarty_3_1_7/distribution/',
                        ),
                    ),
                    null,
                    $rawData->repositories[4]
                ),
            ),
            new Element\ProjectConfiguration(
                'ext',
                'bin',
                111,
                false,
                array('ftp', 'otp'),
                $rawData->config
            ),
            new Element\ScriptConfiguration(
                array('MyVendor\MyClass::preInstall'),
                array('MyVendor\MyClass::postInstall'),
                array('MyVendor\MyClass::preUpdate'),
                array('MyVendor\MyClass::postUpdate'),
                array('MyVendor\MyClass::preStatus'),
                array('MyVendor\MyClass::postStatus'),
                array('MyVendor\MyClass::prePackageInstall'),
                array('MyVendor\MyClass::postPackageInstall'),
                array('MyVendor\MyClass::prePackageUpdate'),
                array('MyVendor\MyClass::postPackageUpdate'),
                array('MyVendor\MyClass::prePackageUninstall'),
                array(
                    'MyVendor\MyClass::postPackageUninstallA',
                    'MyVendor\MyClass::postPackageUninstallB',
                ),
                array('MyVendor\MyClass::preAutoloadDump'),
                array('MyVendor\MyClass::postAutoloadDump'),
                array('MyVendor\MyClass::postRootPackageInstall'),
                array('MyVendor\MyClass::postCreateProjectCmd'),
                $rawData->scripts
            ),
            $rawData->extra,
            array('bin/my-script', 'bin/my-other-script'),
            new Element\ArchiveConfiguration(
                array('patternA', 'patternB'),
                $rawData->archive
            ),
            $rawData
        );

        $data['Full configuration'] = array($expected, $json);

        return $data;
    }

    /**
     * @dataProvider readData
     */
    public function testRead($expected, $json)
    {
        Phake::when($this->isolator)
            ->file_get_contents(Phake::anyParameters())
            ->thenReturn($json)
        ;

        $this->assertEquals($expected, $this->reader->read('/path/to/configuration'));
        Phake::verify($this->isolator)->file_get_contents('/path/to/configuration');
    }

    public function testReadFailureFilesystem()
    {
        $error = Phake::mock('ErrorException');
        Phake::when($this->isolator)
            ->file_get_contents(Phake::anyParameters())
            ->thenThrow($error)
        ;

        $this->setExpectedException(
            __NAMESPACE__.'\Exception\ConfigurationReadException'
        );
        $this->reader->read('/path/to/configuration');
    }

    public function testReadFailureInvalidJSON()
    {
        Phake::when($this->isolator)
            ->file_get_contents(Phake::anyParameters())
            ->thenReturn('{')
        ;

        $this->setExpectedException(
            __NAMESPACE__.'\Exception\InvalidJSONException'
        );
        $this->reader->read('/path/to/configuration');
    }

    public function testReadReal()
    {
        $reader = new ConfigurationReader;
        $path = __DIR__.'/../../composer.json';
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
                'eloquent/enumeration' => '~5',
                'eloquent/liberator' => '~1',
                'icecave/isolator' => '~2',
                'justinrainbow/json-schema' => '~1',
            ),
            array(
                'icecave/archer' => '~1',
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
            null,
            null,
            null,
            null,
            null,
            $rawData
        );

        $this->assertEquals($expected, $reader->read($path));
    }
}
