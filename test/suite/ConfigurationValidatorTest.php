<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration;

use Eloquent\Composer\Configuration\Exception\InvalidConfigurationException;
use Eloquent\Liberator\Liberator;
use Eloquent\Phony\Phpunit\Phony;
use PHPUnit_Framework_TestCase;

class ConfigurationValidatorTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->schema = (object) array();
        $this->innerValidator = Phony::mock('JsonSchema\Validator');
        $this->validator = new ConfigurationValidator($this->schema, $this->innerValidator->get());

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

        $this->fileGetContents = Phony::stubGlobal('file_get_contents', __NAMESPACE__);
    }

    protected function tearDown()
    {
        Phony::restoreGlobalFunctions();
    }

    public function testConstructor()
    {
        $this->assertSame($this->schema, $this->validator->schema());
    }

    public function testConstructorDefaults()
    {
        $schemaJSON = '{"foo": "bar"}';
        $this->fileGetContents->returns($schemaJSON);
        $validator = new ConfigurationValidator();
        $expectedSchema = json_decode($schemaJSON);
        $expectedSchemaPathAtoms = array(dirname(dirname(__DIR__)), 'etc', 'composer-schema.json');
        $expectedSchemaPath = implode(DIRECTORY_SEPARATOR, $expectedSchemaPathAtoms);

        $this->assertEquals($expectedSchema, $validator->schema());
        $this->assertInstanceOf('JsonSchema\Validator', Liberator::liberate($validator)->validator);
        $this->fileGetContents->calledWith($expectedSchemaPath);
    }

    public function testValidate()
    {
        $this->innerValidator->isValid->returns(true);
        $data = (object) array();
        $this->validator->validate($data);

        Phony::inOrder(
            $this->innerValidator->check->calledWith(
                $this->identicalTo($data),
                $this->identicalTo($this->schema)
            ),
            $this->innerValidator->isValid->called()
        );
    }

    public function testValidateFailure()
    {
        $this->innerValidator->isValid->returns(false);
        $this->innerValidator->getErrors->returns($this->errors);
        $data = (object) array();

        $error = null;
        try {
            $this->validator->validate($data);
        } catch (InvalidConfigurationException $error) {
            // verified below
        }

        $this->assertInstanceOf(__NAMESPACE__ . '\Exception\InvalidConfigurationException', $error);
        $this->assertSame($this->errors, $error->errors());
        Phony::inOrder(
            $this->innerValidator->check->calledWith(
                $this->identicalTo($data),
                $this->identicalTo($this->schema)
            ),
            $this->innerValidator->isValid->called()
        );
    }
}
