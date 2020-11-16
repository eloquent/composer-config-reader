<?php

namespace Eloquent\Composer\Configuration\Element;

use PHPUnit\Framework\TestCase;

class ProjectConfigurationTest extends TestCase
{
    public function testConstructor()
    {
        $config = new ProjectConfiguration(
            111,
            true,
            InstallationMethod::DIST(),
            ['ftp', 'otp'],
            ['hostA' => 'tokenA', 'hostB' => 'tokenB'],
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
            ['hostC', 'hostD'],
            false,
            VcsChangePolicy::STASH(),
            'rawData'
        );

        $this->assertSame(111, $config->processTimeout());
        $this->assertTrue($config->useIncludePath());
        $this->assertSame(InstallationMethod::DIST(), $config->preferredInstall());
        $this->assertSame(['ftp', 'otp'], $config->githubProtocols());
        $this->assertSame(['hostA' => 'tokenA', 'hostB' => 'tokenB'], $config->githubOauth());
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
        $this->assertSame(['hostC', 'hostD'], $config->githubDomains());
        $this->assertFalse($config->notifyOnInstall());
        $this->assertSame(VcsChangePolicy::STASH(), $config->discardChanges());
        $this->assertSame('rawData', $config->rawData());
    }

    public function testConstructorDefaults()
    {
        $config = new ProjectConfiguration();

        $this->assertSame(300, $config->processTimeout());
        $this->assertFalse($config->useIncludePath());
        $this->assertSame(InstallationMethod::AUTO(), $config->preferredInstall());
        $this->assertSame(['git', 'https'], $config->githubProtocols());
        $this->assertSame([], $config->githubOauth());
        $this->assertSame('vendor', $config->vendorDir());
        $this->assertSame('vendor/bin', $config->binDir());
        $this->assertNull($config->cacheDir());
        $this->assertNull($config->cacheFilesDir());
        $this->assertNull($config->cacheRepoDir());
        $this->assertNull($config->cacheVcsDir());
        $this->assertSame(6 * 30 * 24 * 60 * 60, $config->cacheFilesTtl());
        $this->assertSame(300 * 1024 * 1024, $config->cacheFilesMaxsize());
        $this->assertTrue($config->prependAutoloader());
        $this->assertNull($config->autoloaderSuffix());
        $this->assertFalse($config->optimizeAutoloader());
        $this->assertSame(['github.com'], $config->githubDomains());
        $this->assertTrue($config->notifyOnInstall());
        $this->assertSame(VcsChangePolicy::IGNORE(), $config->discardChanges());
        $this->assertNull($config->rawData());
    }

    public function testConstructorDefaultsWithCacheDir()
    {
        $config = new ProjectConfiguration(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            '/path/to/cache'
        );

        $this->assertSame('/path/to/cache', $config->cacheDir());
        $this->assertSame('/path/to/cache/files', $config->cacheFilesDir());
        $this->assertSame('/path/to/cache/repo', $config->cacheRepoDir());
        $this->assertSame('/path/to/cache/vcs', $config->cacheVcsDir());
    }
}
