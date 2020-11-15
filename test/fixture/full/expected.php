<?php

namespace Eloquent\Composer\Configuration\Element;

use DateTime;

return new Configuration(
    'monolog/monolog',
    'Logging for PHP 5.3',
    '1.1.0',
    'custom-package-type',
    ['logging', 'events', 'database', 'redis', 'templating'],
    'http://example.org/',
    new DateTime('2011-11-11 11:11:11'),
    ['LGPL-2.1', 'GPL-3.0+'],
    [
        new Author(
            'Nils Adermann',
            'naderman@naderman.de',
            'http://www.naderman.de',
            'Developer',
            $rawData->authors[0]
        ),
        new Author(
            'Jordi Boggiano',
            'j.boggiano@seld.be',
            'http://seld.be',
            'Developer',
            $rawData->authors[1]
        ),
    ],
    new SupportInformation(
        'support@example.org',
        'https://github.com/composer/composer/issues',
        'http://example.org/forum',
        'https://github.com/composer/composer/wiki',
        'irc://irc.freenode.org/composer',
        'https://github.com/composer/composer',
        $rawData->support
    ),
    [
        'monolog/monolog' => '1.0.*@beta',
        'acme/foo' => '@dev',
    ],
    [
        'eloquent/liberator' => '1.*',
        'eloquent/phony' => '1.*',
    ],
    [
        'eloquent/asplode' => '*',
        'eloquent/blox' => '*',
    ],
    [
        'eloquent/cosmos' => '*',
        'eloquent/enumeration' => '*',
    ],
    [
        'eloquent/typhax' => '*',
        'icecave/visita' => '*',
    ],
    [
        'symfony/console' => '*',
        'symfony/filesystem' => '*',
    ],
    [
        'Nermsperce' => ['serse', 'lerb'],
        'Vernder\Nermsperce' => ['serse'],
    ],
    [
        'Monolog' => ['src', 'lib'],
        'Vendor\Namespace' => ['src'],
    ],
    ['src', 'lib', 'Something.php'],
    ['src/MyLibrary/init.php', 'src/MyLibrary/functions.php'],
    ['lib-old', 'src-old'],
    'Symfony/Component/Yaml',
    Stability::DEV(),
    true,
    [
        new Repository(
            'composer',
            'http://packages.example.com',
            null,
            $rawData->repositories[0]
        ),
        new Repository(
            'composer',
            'https://packages.example.com',
            [
                'ssl' => [
                    'verify_peer' => true,
                ],
            ],
            $rawData->repositories[1]
        ),
        new Repository(
            'vcs',
            'https://github.com/Seldaek/monolog',
            null,
            $rawData->repositories[2]
        ),
        new Repository(
            'pear',
            'http://pear2.php.net',
            null,
            $rawData->repositories[3]
        ),
        new PackageRepository(
            [
                'name' => 'smarty/smarty',
                'version' => '3.1.7',
                'dist' => [
                    'url' => 'http://www.smarty.net/files/Smarty-3.1.7.zip',
                    'type' => 'zip',
                ],
                'source' => [
                    'url' => 'http://smarty-php.googlecode.com/svn/',
                    'type' => 'svn',
                    'reference' => 'tags/Smarty_3_1_7/distribution/',
                ],
            ],
            null,
            $rawData->repositories[4]
        ),
    ],
    new ProjectConfiguration(
        111,
        true,
        InstallationMethod::DIST(),
        ['ftp', 'otp'],
        ['hostA' => 'tokenA', 'hostB' => 'tokenB'],
        'ext',
        'bin',
        'cache',
        'cache-files',
        'cache-repo',
        'cache-vcs',
        222,
        333,
        false,
        'autoloaderSuffix',
        true,
        ['hostC', 'hostD'],
        false,
        VcsChangePolicy::DISCARD(),
        $rawData->config
    ),
    new ScriptConfiguration(
        ['MyVendor\MyClass::preInstall'],
        ['MyVendor\MyClass::postInstall'],
        ['MyVendor\MyClass::preUpdate'],
        ['MyVendor\MyClass::postUpdate'],
        ['MyVendor\MyClass::preStatus'],
        ['MyVendor\MyClass::postStatus'],
        ['MyVendor\MyClass::prePackageInstall'],
        ['MyVendor\MyClass::postPackageInstall'],
        ['MyVendor\MyClass::prePackageUpdate'],
        ['MyVendor\MyClass::postPackageUpdate'],
        ['MyVendor\MyClass::prePackageUninstall'],
        [
            'MyVendor\MyClass::postPackageUninstallA',
            'MyVendor\MyClass::postPackageUninstallB',
        ],
        ['MyVendor\MyClass::preAutoloadDump'],
        ['MyVendor\MyClass::postAutoloadDump'],
        ['MyVendor\MyClass::postRootPackageInstall'],
        ['MyVendor\MyClass::postCreateProjectCmd'],
        $rawData->scripts
    ),
    $rawData->extra,
    ['bin/my-script', 'bin/my-other-script'],
    new ArchiveConfiguration(
        ['patternA', 'patternB'],
        $rawData->archive
    ),
    $rawData
);
