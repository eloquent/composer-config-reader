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

use Icecave\Isolator\Isolator;
use JsonSchema\Validator;
use stdClass;

class ConfigurationValidator
{
    /**
     * @param stdClass|null $schema
     * @param Validator|null $validator
     */
    public function __construct(
        stdClass $schema = null,
        Validator $validator = null,
        Isolator $isolator = null
    ) {
        $this->isolator = Isolator::get($isolator);

        if (null === $schema) {
            $schema = $this->loadDefaultSchema();
        }
        if (null === $validator) {
            $validator = new Validator;
        }

        $this->schema = $schema;
        $this->validator = $validator;
    }

    /**
     * @return stdClass
     */
    public function schema()
    {
        return $this->schema;
    }

    /**
     * @param mixed $data
     *
     * @throws Exception\InvalidJSONException
     */
    public function validate($data)
    {
        $this->validator->reset();
        $this->validator->check($data, $this->schema());

        if (!$this->validator->isValid()) {
            throw new Exception\InvalidJSONException(
                $this->validator->getErrors()
            );
        }
    }

    /**
     * @return stdClass
     */
    protected function loadDefaultSchema()
    {
        return json_decode(
            $this->isolator->file_get_contents($this->defaultSchemaPath())
        );
    }

    /**
     * @return string
     */
    protected function defaultSchemaPath()
    {
        $atoms = array(
            dirname(dirname(dirname(dirname(__DIR__)))),
            'etc',
            'composer-schema.json',
        );

        return implode(DIRECTORY_SEPARATOR, $atoms);
    }

    private $schema;
    private $validator;
    private $isolator;
}