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

final class InvalidConfigurationException extends RuntimeException implements ConfigurationException
{
    /**
     * @param array<array<string>> $errors
     * @param Exception|null       $previous
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
     * @return array<array<string>>
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
                ' * [%s] %s',
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
