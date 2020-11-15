<?php

namespace Eloquent\Composer\Configuration;

use Eloquent\Composer\Configuration\Exception\InvalidConfigurationException;
use Eloquent\Phony\Phpunit\Phony;
use PHPUnit\Framework\TestCase;
use ReflectionObject;

class ConfigurationValidatorTest extends TestCase
{
    protected function setUp(): void
    {
        $this->schema = (object) [];
        $this->innerValidator = Phony::mock('JsonSchema\Validator');
        $this->validator = new ConfigurationValidator($this->schema, $this->innerValidator->get());

        $this->errors = [
            [
                'property' => 'foo',
                'message' => 'bar',
            ],
            [
                'property' => 'baz',
                'message' => 'qux',
            ],
        ];

        $this->fileGetContents = Phony::stubGlobal('file_get_contents', __NAMESPACE__);
    }

    protected function tearDown(): void
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
        $validatorObject = new ReflectionObject($validator);
        $validatorProperty = $validatorObject->getProperty('validator');
        $validatorProperty->setAccessible(true);
        $expectedSchema = json_decode($schemaJSON);
        $expectedSchemaPathAtoms = [dirname(dirname(__DIR__)), 'etc', 'composer-schema.json'];
        $expectedSchemaPath = implode(DIRECTORY_SEPARATOR, $expectedSchemaPathAtoms);

        $this->assertEquals($expectedSchema, $validator->schema());
        $this->assertInstanceOf('JsonSchema\Validator', $validatorProperty->getValue($validator));
        $this->fileGetContents->calledWith($expectedSchemaPath);
    }

    public function testValidate()
    {
        $this->innerValidator->isValid->returns(true);
        $data = (object) [];
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
        $data = (object) [];

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
