<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Domain;

use Phake;
use PHPUnit_Framework_TestCase;

class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->_time = Phake::mock('DateTime');
        $this->_authors = array(
            Phake::mock(__NAMESPACE__.'\Author'),
            Phake::mock(__NAMESPACE__.'\Author'),
        );
        $this->_support = Phake::mock(__NAMESPACE__.'\SupportInformation');
        $this->_minimumStability = Stability::DEV();
        $this->_repositories = array(
            Phake::mock(__NAMESPACE__.'\Repository'),
            Phake::mock(__NAMESPACE__.'\Repository'),
        );
        $this->_config = Phake::mock(__NAMESPACE__.'\ProjectConfiguration');
        $this->_scripts = Phake::mock(__NAMESPACE__.'\ScriptConfiguration');
        $this->_configuration = new Configuration(
            'foo',
            'bar',
            'baz',
            'qux',
            array('doom', 'splat'),
            'ping',
            $this->_time,
            array('pong', 'prong'),
            $this->_authors,
            $this->_support,
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
            $this->_minimumStability,
            $this->_repositories,
            $this->_config,
            $this->_scripts,
            'mot',
            array('mut', 'rat'),
            'ret'
        );
    }

    public function testConstructor()
    {
        $this->assertSame('foo', $this->_configuration->name());
        $this->assertSame('bar', $this->_configuration->description());
        $this->assertSame('baz', $this->_configuration->version());
        $this->assertSame('qux', $this->_configuration->type());
        $this->assertSame(array('doom', 'splat'), $this->_configuration->keywords());
        $this->assertSame('ping', $this->_configuration->homepage());
        $this->assertSame($this->_time, $this->_configuration->time());
        $this->assertSame(array('pong', 'prong'), $this->_configuration->license());
        $this->assertSame($this->_authors, $this->_configuration->authors());
        $this->assertSame($this->_support, $this->_configuration->support());
        $this->assertSame(array('pang' => 'peng'), $this->_configuration->dependencies());
        $this->assertSame(array('pung' => 'pip'), $this->_configuration->devDependencies());
        $this->assertSame(array('pop' => 'pap'), $this->_configuration->conflict());
        $this->assertSame(array('pep' => 'pup'), $this->_configuration->replace());
        $this->assertSame(array('bat' => 'bet'), $this->_configuration->provide());
        $this->assertSame(array('bit' => 'bot'), $this->_configuration->suggest());
        $this->assertSame(array(
            'but' => array('tat', 'tart'),
            'wert' => array('wurt'),
        ), $this->_configuration->autoloadPSR0());
        $this->assertSame(array('tet', 'tit'), $this->_configuration->autoloadClassmap());
        $this->assertSame(array('tot', 'tut'), $this->_configuration->autoloadFiles());
        $this->assertSame(array('mat', 'met'), $this->_configuration->includePath());
        $this->assertSame('mit', $this->_configuration->targetDir());
        $this->assertSame($this->_minimumStability, $this->_configuration->minimumStability());
        $this->assertSame($this->_repositories, $this->_configuration->repositories());
        $this->assertSame($this->_config, $this->_configuration->config());
        $this->assertSame($this->_scripts, $this->_configuration->scripts());
        $this->assertSame('mot', $this->_configuration->extra());
        $this->assertSame(array('mut', 'rat'), $this->_configuration->bin());
        $this->assertSame('ret', $this->_configuration->rawData());
    }

    public function testConstructorDefaults()
    {
        $configuration = new Configuration;

        $this->assertNull($configuration->name());
        $this->assertNull($configuration->description());
        $this->assertNull($configuration->version());
        $this->assertSame('library', $configuration->type());
        $this->assertSame(array(), $configuration->keywords());
        $this->assertNull($configuration->homepage());
        $this->assertNull($configuration->time());
        $this->assertSame(array(), $configuration->license());
        $this->assertSame(array(), $configuration->authors());
        $this->assertInstanceOf(__NAMESPACE__.'\SupportInformation', $configuration->support());
        $this->assertSame(array(), $configuration->dependencies());
        $this->assertSame(array(), $configuration->devDependencies());
        $this->assertSame(array(), $configuration->conflict());
        $this->assertSame(array(), $configuration->replace());
        $this->assertSame(array(), $configuration->provide());
        $this->assertSame(array(), $configuration->suggest());
        $this->assertSame(array(), $configuration->autoloadPSR0());
        $this->assertSame(array(), $configuration->autoloadClassmap());
        $this->assertSame(array(), $configuration->autoloadFiles());
        $this->assertSame(array(), $configuration->includePath());
        $this->assertNull($configuration->targetDir());
        $this->assertSame(Stability::STABLE(), $configuration->minimumStability());
        $this->assertSame(array(), $configuration->repositories());
        $this->assertInstanceOf(__NAMESPACE__.'\ProjectConfiguration', $configuration->config());
        $this->assertInstanceOf(__NAMESPACE__.'\ScriptConfiguration', $configuration->scripts());
        $this->assertNull($configuration->extra());
        $this->assertSame(array(), $configuration->bin());
        $this->assertNull($configuration->rawData());
    }

    public function testAllDependencies()
    {
        $this->assertSame(array(
            'pang' => 'peng',
            'pung' => 'pip',
        ), $this->_configuration->allDependencies());
    }

    public function testAllPSR0SourcePaths()
    {
        $this->assertSame(array(
            'tat',
            'tart',
            'wurt',
        ), $this->_configuration->allPSR0SourcePaths());
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
        ), $this->_configuration->allSourcePaths());
    }
}
