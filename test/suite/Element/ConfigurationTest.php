<?php

namespace Eloquent\Composer\Configuration\Element;

use Eloquent\Phony\Phpunit\Phony;
use PHPUnit\Framework\TestCase;
use ReflectionObject;

class ConfigurationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->time = Phony::mock('DateTime')->get();
        $this->authors = [
            Phony::mock(__NAMESPACE__ . '\Author')->get(),
            Phony::mock(__NAMESPACE__ . '\Author')->get(),
        ];
        $this->support = Phony::mock(__NAMESPACE__ . '\SupportInformation')->get();
        $this->minimumStability = Stability::DEV();
        $this->repositories = [
            Phony::mock(__NAMESPACE__ . '\Repository')->get(),
            Phony::mock(__NAMESPACE__ . '\Repository')->get(),
        ];
        $this->config = Phony::mock(__NAMESPACE__ . '\ProjectConfiguration')->get();
        $this->scripts = Phony::mock(__NAMESPACE__ . '\ScriptConfiguration')->get();
        $this->archive = Phony::mock(__NAMESPACE__ . '\ArchiveConfiguration')->get();
        $this->configuration = new Configuration(
            'foo',
            'bar',
            'baz',
            'qux',
            ['doom', 'splat'],
            'ping',
            $this->time,
            ['pong', 'prong'],
            $this->authors,
            $this->support,
            ['pang' => 'peng'],
            ['pung' => 'pip'],
            ['pop' => 'pap'],
            ['pep' => 'pup'],
            ['bat' => 'bet'],
            ['bit' => 'bot'],
            [
                'flim' => ['flam', 'jim'],
                'jam' => ['jem'],
            ],
            [
                'but' => ['tat', 'tart'],
                'wert' => ['wurt'],
            ],
            ['tet', 'tit'],
            ['tot', 'tut'],
            ['mat', 'met'],
            'mit',
            $this->minimumStability,
            true,
            $this->repositories,
            $this->config,
            $this->scripts,
            'mot',
            ['mut', 'rat'],
            $this->archive,
            'ret'
        );
    }

    public function testNoPublicMembers()
    {
        $reflector = new ReflectionObject($this->configuration);
        foreach ($reflector->getProperties() as $property) {
            $this->assertFalse($property->isPublic());
        }
    }

    public function testConstructor()
    {
        $this->assertSame('foo', $this->configuration->name());
        $this->assertSame('bar', $this->configuration->description());
        $this->assertSame('baz', $this->configuration->version());
        $this->assertSame('qux', $this->configuration->type());
        $this->assertSame(['doom', 'splat'], $this->configuration->keywords());
        $this->assertSame('ping', $this->configuration->homepage());
        $this->assertSame($this->time, $this->configuration->time());
        $this->assertSame(['pong', 'prong'], $this->configuration->license());
        $this->assertSame($this->authors, $this->configuration->authors());
        $this->assertSame($this->support, $this->configuration->support());
        $this->assertSame(['pang' => 'peng'], $this->configuration->dependencies());
        $this->assertSame(['pung' => 'pip'], $this->configuration->devDependencies());
        $this->assertSame(['pop' => 'pap'], $this->configuration->conflict());
        $this->assertSame(['pep' => 'pup'], $this->configuration->replace());
        $this->assertSame(['bat' => 'bet'], $this->configuration->provide());
        $this->assertSame(['bit' => 'bot'], $this->configuration->suggest());
        $this->assertSame([
            'but' => ['tat', 'tart'],
            'wert' => ['wurt'],
        ], $this->configuration->autoloadPsr0());
        $this->assertSame(['tet', 'tit'], $this->configuration->autoloadClassmap());
        $this->assertSame(['tot', 'tut'], $this->configuration->autoloadFiles());
        $this->assertSame(['mat', 'met'], $this->configuration->includePath());
        $this->assertSame('mit', $this->configuration->targetDir());
        $this->assertSame($this->minimumStability, $this->configuration->minimumStability());
        $this->assertTrue($this->configuration->preferStable());
        $this->assertSame($this->repositories, $this->configuration->repositories());
        $this->assertSame($this->config, $this->configuration->config());
        $this->assertSame($this->scripts, $this->configuration->scripts());
        $this->assertSame('mot', $this->configuration->extra());
        $this->assertSame(['mut', 'rat'], $this->configuration->bin());
        $this->assertSame($this->archive, $this->configuration->archive());
        $this->assertSame('ret', $this->configuration->rawData());
    }

    public function testConstructorDefaults()
    {
        $this->configuration = new Configuration();

        $this->assertNull($this->configuration->name());
        $this->assertNull($this->configuration->description());
        $this->assertNull($this->configuration->version());
        $this->assertSame('library', $this->configuration->type());
        $this->assertSame([], $this->configuration->keywords());
        $this->assertNull($this->configuration->homepage());
        $this->assertNull($this->configuration->time());
        $this->assertSame([], $this->configuration->license());
        $this->assertSame([], $this->configuration->authors());
        $this->assertInstanceOf(__NAMESPACE__ . '\SupportInformation', $this->configuration->support());
        $this->assertSame([], $this->configuration->dependencies());
        $this->assertSame([], $this->configuration->devDependencies());
        $this->assertSame([], $this->configuration->conflict());
        $this->assertSame([], $this->configuration->replace());
        $this->assertSame([], $this->configuration->provide());
        $this->assertSame([], $this->configuration->suggest());
        $this->assertSame([], $this->configuration->autoloadPsr0());
        $this->assertSame([], $this->configuration->autoloadClassmap());
        $this->assertSame([], $this->configuration->autoloadFiles());
        $this->assertSame([], $this->configuration->includePath());
        $this->assertNull($this->configuration->targetDir());
        $this->assertSame(Stability::STABLE(), $this->configuration->minimumStability());
        $this->assertFalse($this->configuration->preferStable());
        $this->assertSame([], $this->configuration->repositories());
        $this->assertInstanceOf(__NAMESPACE__ . '\ProjectConfiguration', $this->configuration->config());
        $this->assertInstanceOf(__NAMESPACE__ . '\ScriptConfiguration', $this->configuration->scripts());
        $this->assertNull($this->configuration->extra());
        $this->assertSame([], $this->configuration->bin());
        $this->assertInstanceOf(__NAMESPACE__ . '\ArchiveConfiguration', $this->configuration->archive());
        $this->assertNull($this->configuration->rawData());
    }

    public function testProjectName()
    {
        $configuration = new Configuration('foo/bar/baz');

        $this->assertSame('baz', $configuration->projectName());

        $configuration = new Configuration();

        $this->assertNull($configuration->projectName());
    }

    public function testVendorName()
    {
        $configuration = new Configuration('foo/bar/baz');

        $this->assertSame('foo/bar', $configuration->vendorName());

        $configuration = new Configuration();

        $this->assertNull($configuration->vendorName());

        $configuration = new Configuration('foo');

        $this->assertNull($configuration->vendorName());
    }

    public function testAllDependencies()
    {
        $this->assertSame([
            'pang' => 'peng',
            'pung' => 'pip',
        ], $this->configuration->allDependencies());
    }

    public function testAllPsr0SourcePaths()
    {
        $this->assertSame([
            'tat',
            'tart',
            'wurt',
        ], $this->configuration->allPsr0SourcePaths());
    }

    public function testAllSourcePaths()
    {
        $this->assertSame([
            'flam',
            'jim',
            'jem',
            'tat',
            'tart',
            'wurt',
            'tet',
            'tit',
            'tot',
            'tut',
            'mat',
            'met',
        ], $this->configuration->allSourcePaths());
    }
}
