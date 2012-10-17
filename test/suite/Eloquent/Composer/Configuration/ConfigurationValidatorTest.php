<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

use Eloquent\Liberator\Liberator;
use Phake;
use PHPUnit_Framework_TestCase;
use stdClass;

class ConfigurationValidatorTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->_schema = Phake::mock('stdClass');
        $this->_innerValidator = Phake::mock('JsonSchema\Validator');
        $this->_isolator = Phake::mock('Icecave\Isolator\Isolator');
        $this->_validator = new ConfigurationValidator(
            $this->_schema,
            $this->_innerValidator,
            $this->_isolator
        );

        $this->_errors = array(
            array(
                'property' => 'foo',
                'message' => 'bar',
            ),
            array(
                'property' => 'baz',
                'message' => 'qux',
            ),
        );
    }

    public function testConstructor()
    {
        $this->assertSame($this->_schema, $this->_validator->schema());
    }

    public function testConstructorDefaults()
    {
        $schemaJSON = '{"foo": "bar"}';
        Phake::when($this->_isolator)
            ->file_get_contents(Phake::anyParameters())
            ->thenReturn($schemaJSON)
        ;
        $validator = new ConfigurationValidator(
            null,
            null,
            $this->_isolator
        );
        $expectedSchema = json_decode($schemaJSON);
        $expectedSchemaPathAtoms = array(
            dirname(dirname(dirname(dirname(dirname(__DIR__))))),
            'etc',
            'composer-schema.json',
        );
        $expectedSchemaPath = implode(DIRECTORY_SEPARATOR, $expectedSchemaPathAtoms);

        $this->assertEquals(
            $expectedSchema,
            $validator->schema()
        );
        $this->assertInstanceOf(
            'JsonSchema\Validator',
            Liberator::liberate($validator)->validator
        );
        Phake::verify($this->_isolator)->file_get_contents($expectedSchemaPath);
    }

    public function testValidate()
    {
        Phake::when($this->_innerValidator)
            ->isValid(Phake::anyParameters())
            ->thenReturn(true)
        ;
        $data = Phake::mock('stdClass');
        $this->_validator->validate($data);

        Phake::inOrder(
            Phake::verify($this->_innerValidator)->reset(),
            Phake::verify($this->_innerValidator)->check(
                $this->identicalTo($data),
                $this->identicalTo($this->_schema)
            ),
            Phake::verify($this->_innerValidator)->isValid()
        );
    }

    public function testValidateFailure()
    {
        Phake::when($this->_innerValidator)
            ->isValid(Phake::anyParameters())
            ->thenReturn(false)
        ;
        Phake::when($this->_innerValidator)
            ->getErrors(Phake::anyParameters())
            ->thenReturn($this->_errors)
        ;
        $data = Phake::mock('stdClass');

        $error = null;
        try {
            $this->_validator->validate($data);
        } catch (Exception\InvalidJSONException $error) {
            // verified below
        }

        $this->assertInstanceOf(
            __NAMESPACE__.'\Exception\InvalidJSONException',
            $error
        );
        $this->assertSame($this->_errors, $error->errors());
        Phake::inOrder(
            Phake::verify($this->_innerValidator)->reset(),
            Phake::verify($this->_innerValidator)->check(
                $this->identicalTo($data),
                $this->identicalTo($this->_schema)
            ),
            Phake::verify($this->_innerValidator)->isValid()
        );
    }
}
