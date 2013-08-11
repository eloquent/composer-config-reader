<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

use Phake;
use PHPUnit_Framework_TestCase;
use ReflectionObject;

class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->time = Phake::mock('DateTime');
        $this->authors = array(
            Phake::mock(__NAMESPACE__.'\Author'),
            Phake::mock(__NAMESPACE__.'\Author'),
        );
        $this->support = Phake::mock(__NAMESPACE__.'\SupportInformation');
        $this->minimumStability = Stability::DEV();
        $this->repositories = array(
            Phake::mock(__NAMESPACE__.'\Repository'),
            Phake::mock(__NAMESPACE__.'\Repository'),
        );
        $this->config = Phake::mock(__NAMESPACE__.'\ProjectConfiguration');
        $this->scripts = Phake::mock(__NAMESPACE__.'\ScriptConfiguration');
        $this->archive = Phake::mock(__NAMESPACE__.'\ArchiveConfiguration');
        $this->configuration = new Configuration(
            'foo',
            'bar',
            'baz',
            'qux',
            array('doom', 'splat'),
            'ping',
            $this->time,
            array('pong', 'prong'),
            $this->authors,
            $this->support,
            array('pang' => 'peng'),
            array('pung' => 'pip'),
            array('pop' => 'pap'),
            array('pep' => 'pup'),
            array('bat' => 'bet'),
            array('bit' => 'bot'),
            array(
                'but' => array('tat', 'tart'),
                'wert' => array('wurt'),
            ),
            array('tet', 'tit'),
            array('tot', 'tut'),
            array('mat', 'met'),
            'mit',
            $this->minimumStability,
            true,
            $this->repositories,
            $this->config,
            $this->scripts,
            'mot',
            array('mut', 'rat'),
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
        $this->assertSame(array('doom', 'splat'), $this->configuration->keywords());
        $this->assertSame('ping', $this->configuration->homepage());
        $this->assertSame($this->time, $this->configuration->time());
        $this->assertSame(array('pong', 'prong'), $this->configuration->license());
        $this->assertSame($this->authors, $this->configuration->authors());
        $this->assertSame($this->support, $this->configuration->support());
        $this->assertSame(array('pang' => 'peng'), $this->configuration->dependencies());
        $this->assertSame(array('pung' => 'pip'), $this->configuration->devDependencies());
        $this->assertSame(array('pop' => 'pap'), $this->configuration->conflict());
        $this->assertSame(array('pep' => 'pup'), $this->configuration->replace());
        $this->assertSame(array('bat' => 'bet'), $this->configuration->provide());
        $this->assertSame(array('bit' => 'bot'), $this->configuration->suggest());
        $this->assertSame(array(
            'but' => array('tat', 'tart'),
            'wert' => array('wurt'),
        ), $this->configuration->autoloadPsr0());
        $this->assertSame(array('tet', 'tit'), $this->configuration->autoloadClassmap());
        $this->assertSame(array('tot', 'tut'), $this->configuration->autoloadFiles());
        $this->assertSame(array('mat', 'met'), $this->configuration->includePath());
        $this->assertSame('mit', $this->configuration->targetDir());
        $this->assertSame($this->minimumStability, $this->configuration->minimumStability());
        $this->assertTrue($this->configuration->preferStable());
        $this->assertSame($this->repositories, $this->configuration->repositories());
        $this->assertSame($this->config, $this->configuration->config());
        $this->assertSame($this->scripts, $this->configuration->scripts());
        $this->assertSame('mot', $this->configuration->extra());
        $this->assertSame(array('mut', 'rat'), $this->configuration->bin());
        $this->assertSame($this->archive, $this->configuration->archive());
        $this->assertSame('ret', $this->configuration->rawData());
    }

    public function testConstructorDefaults()
    {
        $this->configuration = new Configuration;

        $this->assertNull($this->configuration->name());
        $this->assertNull($this->configuration->description());
        $this->assertNull($this->configuration->version());
        $this->assertSame('library', $this->configuration->type());
        $this->assertSame(array(), $this->configuration->keywords());
        $this->assertNull($this->configuration->homepage());
        $this->assertNull($this->configuration->time());
        $this->assertSame(array(), $this->configuration->license());
        $this->assertSame(array(), $this->configuration->authors());
        $this->assertInstanceOf(__NAMESPACE__.'\SupportInformation', $this->configuration->support());
        $this->assertSame(array(), $this->configuration->dependencies());
        $this->assertSame(array(), $this->configuration->devDependencies());
        $this->assertSame(array(), $this->configuration->conflict());
        $this->assertSame(array(), $this->configuration->replace());
        $this->assertSame(array(), $this->configuration->provide());
        $this->assertSame(array(), $this->configuration->suggest());
        $this->assertSame(array(), $this->configuration->autoloadPsr0());
        $this->assertSame(array(), $this->configuration->autoloadClassmap());
        $this->assertSame(array(), $this->configuration->autoloadFiles());
        $this->assertSame(array(), $this->configuration->includePath());
        $this->assertNull($this->configuration->targetDir());
        $this->assertSame(Stability::STABLE(), $this->configuration->minimumStability());
        $this->assertFalse($this->configuration->preferStable());
        $this->assertSame(array(), $this->configuration->repositories());
        $this->assertInstanceOf(__NAMESPACE__.'\ProjectConfiguration', $this->configuration->config());
        $this->assertInstanceOf(__NAMESPACE__.'\ScriptConfiguration', $this->configuration->scripts());
        $this->assertNull($this->configuration->extra());
        $this->assertSame(array(), $this->configuration->bin());
        $this->assertInstanceOf(__NAMESPACE__.'\ArchiveConfiguration', $this->configuration->archive());
        $this->assertNull($this->configuration->rawData());
    }

    public function testProjectName()
    {
        $configuration = new Configuration('foo/bar/baz');

        $this->assertSame('baz', $configuration->projectName());

        $configuration = new Configuration;

        $this->assertNull($configuration->projectName());
    }

    public function testVendorName()
    {
        $configuration = new Configuration('foo/bar/baz');

        $this->assertSame('foo/bar', $configuration->vendorName());

        $configuration = new Configuration;

        $this->assertNull($configuration->vendorName());

        $configuration = new Configuration('foo');

        $this->assertNull($configuration->vendorName());
    }

    public function testAllDependencies()
    {
        $this->assertSame(array(
            'pang' => 'peng',
            'pung' => 'pip',
        ), $this->configuration->allDependencies());
    }

    public function testAllPsr0SourcePaths()
    {
        $this->assertSame(array(
            'tat',
            'tart',
            'wurt',
        ), $this->configuration->allPsr0SourcePaths());
    }

    public function testAllSourcePaths()
    {
        $this->assertSame(array(
            'tat',
            'tart',
            'wurt',
            'tet',
            'tit',
            'tot',
            'tut',
            'mat',
            'met',
        ), $this->configuration->allSourcePaths());
    }
}
