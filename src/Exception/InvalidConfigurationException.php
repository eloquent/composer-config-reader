<?php

namespace Eloquent\Composer\Configuration\Exception;

use Exception;

/**
 * The configuration is invalid.
 */
final class InvalidConfigurationException extends Exception implements
    ConfigurationExceptionInterface
{
    /**
     * Construct a new invalid configuration exception.
     *
     * @param array<integer,array<integer,string>> $errors   The errors in the configuration.
     * @param Exception|null                       $previous The cause, if available.
     */
    public function __construct(array $errors, Exception $previous = null)
    {
        $this->errors = $errors;

        parent::__construct($this->buildMessage($errors), 0, $previous);
    }

    /**
     * Get the errors in the configuration.
     *
     * @return array<integer,array<integer,string>> The configuration errors.
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Build the exception message.
     *
     * @param array<integer,array<integer,string>> $errors The errors in the configuration.
     *
     * @return string The exception message.
     */
    protected function buildMessage(array $errors)
    {
        $errorList = [];
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
