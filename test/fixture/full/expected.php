<?php

namespace Eloquent\Composer\Configuration\Element;

use DateTime;

return new Configuration(
    'monolog/monolog',
    'Logging for PHP 5.3',
    '1.1.0',
    'custom-package-type',
    array('logging', 'events', 'database', 'redis', 'templating'),
    'http://example.org/',
    new DateTime('2011-11-11 11:11:11'),
    array('LGPL-2.1', 'GPL-3.0+'),
    array(
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
    ),
    new SupportInformation(
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
    Stability::DEV(),
    true,
    array(
        new Repository(
            'composer',
            'http://packages.example.com',
            null,
            $rawData->repositories[0]
        ),
        new Repository(
            'composer',
            'https://packages.example.com',
            array(
                'ssl' => array(
                    'verify_peer' => true,
                ),
            ),
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
    new ProjectConfiguration(
        111,
        true,
        InstallationMethod::DIST(),
        array('ftp', 'otp'),
        array('hostA' => 'tokenA', 'hostB' => 'tokenB'),
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
        array('hostC', 'hostD'),
        false,
        VcsChangePolicy::DISCARD(),
        $rawData->config
    ),
    new ScriptConfiguration(
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
    new ArchiveConfiguration(
        array('patternA', 'patternB'),
        $rawData->archive
    ),
    $rawData
);
