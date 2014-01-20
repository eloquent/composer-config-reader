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

use Eloquent\Liberator\Liberator;
use Phake;
use PHPUnit_Framework_TestCase;
use stdClass;

class ConfigurationValidatorTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->schema = Phake::mock('stdClass');
        $this->innerValidator = Phake::mock('JsonSchema\Validator');
        $this->isolator = Phake::mock('Icecave\Isolator\Isolator');
        $this->validator = new ConfigurationValidator(
            $this->schema,
            $this->innerValidator,
            $this->isolator
        );

        $this->errors = array(
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
        $this->assertSame($this->schema, $this->validator->schema());
    }

    public function testConstructorDefaults()
    {
        $schemaJSON = '{"foo": "bar"}';
        Phake::when($this->isolator)
            ->file_get_contents(Phake::anyParameters())
            ->thenReturn($schemaJSON)
        ;
        $validator = new ConfigurationValidator(
            null,
            null,
            $this->isolator
        );
        $expectedSchema = json_decode($schemaJSON);
        $expectedSchemaPathAtoms = array(
            dirname(dirname(__DIR__)),
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
        Phake::verify($this->isolator)->file_get_contents($expectedSchemaPath);
    }

    public function testValidate()
    {
        Phake::when($this->innerValidator)
            ->isValid(Phake::anyParameters())
            ->thenReturn(true)
        ;
        $data = Phake::mock('stdClass');
        $this->validator->validate($data);

        Phake::inOrder(
            Phake::verify($this->innerValidator)->check(
                $this->identicalTo($data),
                $this->identicalTo($this->schema)
            ),
            Phake::verify($this->innerValidator)->isValid()
        );
    }

    public function testValidateFailure()
    {
        Phake::when($this->innerValidator)
            ->isValid(Phake::anyParameters())
            ->thenReturn(false)
        ;
        Phake::when($this->innerValidator)
            ->getErrors(Phake::anyParameters())
            ->thenReturn($this->errors)
        ;
        $data = Phake::mock('stdClass');

        $error = null;
        try {
            $this->validator->validate($data);
        } catch (Exception\InvalidConfigurationException $error) {
            // verified below
        }

        $this->assertInstanceOf(
            __NAMESPACE__.'\Exception\InvalidConfigurationException',
            $error
        );
        $this->assertSame($this->errors, $error->errors());
        Phake::inOrder(
            Phake::verify($this->innerValidator)->check(
                $this->identicalTo($data),
                $this->identicalTo($this->schema)
            ),
            Phake::verify($this->innerValidator)->isValid()
        );
    }
}
