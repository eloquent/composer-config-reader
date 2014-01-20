<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Exception;

use Exception;
use RuntimeException;

/**
 * The configuration is invalid.
 */
final class InvalidConfigurationException extends RuntimeException implements
    ConfigurationExceptionInterface
{
    /**
     * Construct a new invalid configuration exception.
     *
     * @param array<array<string>> $errors   The errors in the configuration.
     * @param Exception|null       $previous The cause, if available.
     */
    public function __construct(array $errors, Exception $previous = null)
    {
        $this->errors = $errors;

        parent::__construct(
            $this->buildMessage($errors),
            0,
            $previous
        );
    }

    /**
     * Get the errors in the configuration.
     *
     * @return array<array<string>> The configuration errors.
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * @param array<array<string>> $errors
     *
     * @return string
     */
    protected function buildMessage(array $errors)
    {
        $errorList = array();
        foreach ($errors as $error) {
            $errorList[] = sprintf(
                '  - [%s] %s',
                $error['property'],
                $error['message']
            );
        }

        return sprintf(
            "The supplied Composer configuration is invalid:\n%s",
            implode("\n", $errorList)
        );
    }

    private $errors;
}
