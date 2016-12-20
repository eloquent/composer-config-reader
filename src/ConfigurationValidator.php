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

use Eloquent\Composer\Configuration\Exception\ConfigurationExceptionInterface;
use Eloquent\Composer\Configuration\Exception\InvalidConfigurationException;
use JsonSchema\Validator;
use stdClass;

/**
 * Validates composer data.
 */
class ConfigurationValidator
{
    /**
     * Construct a new configuration validator.
     *
     * @param stdClass|null  $schema    The schema to use.
     * @param Validator|null $validator The JSON schema validator to use.
     */
    public function __construct(
        stdClass $schema = null,
        Validator $validator = null
    ) {
        if (null === $schema) {
            $schema = $this->loadDefaultSchema();
        }
        if (null === $validator) {
            $validator = new Validator();
        }

        $this->schema = $schema;
        $this->validator = $validator;
    }

    /**
     * Get the schema.
     *
     * @return stdClass The schema.
     */
    public function schema()
    {
        return $this->schema;
    }

    /**
     * Validate Composer configuration data.
     *
     * @param mixed $data The configuration data.
     *
     * @throws ConfigurationExceptionInterface If the data is invalid.
     */
    public function validate($data)
    {
        $this->validator->reset();
        $this->validator->check($data, $this->schema());

        if (!$this->validator->isValid()) {
            throw new InvalidConfigurationException(
                $this->validator->getErrors()
            );
        }
    }

    /**
     * Load the default Composer configuration schema.
     *
     * @return stdClass The parsed schema.
     */
    protected function loadDefaultSchema()
    {
        return json_decode(file_get_contents($this->defaultSchemaPath()));
    }

    /**
     * Get the default Composer configuration schema path.
     *
     * @return string The schema path.
     */
    protected function defaultSchemaPath()
    {
        return implode(
            DIRECTORY_SEPARATOR,
            array(dirname(__DIR__), 'etc', 'composer-schema.json')
        );
    }

    private $schema;
    private $validator;
}
