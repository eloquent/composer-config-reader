<?php

namespace Eloquent\Composer\Configuration\Exception;

use Exception;

/**
 * The configuration contains invalid JSON data.
 */
final class InvalidJsonException extends Exception implements
    ConfigurationExceptionInterface
{
    /**
     * Construct a new invalid JSON exception.
     *
     * @param string         $path          The path to the configuration.
     * @param int            $jsonErrorCode The error code supplied by PHP.
     * @param Exception|null $previous      The cause, if available.
     */
    public function __construct(
        $path,
        $jsonErrorCode,
        Exception $previous = null
    ) {
        $this->path = $path;
        $this->jsonErrorCode = $jsonErrorCode;
        switch ($jsonErrorCode) {
            case JSON_ERROR_DEPTH:
                $this->jsonErrorMessage =
                    'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $this->jsonErrorMessage = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $this->jsonErrorMessage =
                    'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $this->jsonErrorMessage = 'Syntax error.';
                break;
            case JSON_ERROR_UTF8:
                $this->jsonErrorMessage =
                    'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
            default:
                $this->jsonErrorMessage = 'Unknown error.';
        }

        parent::__construct(
            sprintf(
                "Invalid JSON in Composer configuration at '%s': %s",
                $this->path(),
                $this->jsonErrorMessage()
            ),
            0,
            $previous
        );
    }

    /**
     * Get the path to the configuration.
     *
     * @return string The configuration path.
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * Get the error code supplied by PHP.
     *
     * @return int The error code.
     */
    public function jsonErrorCode()
    {
        return $this->jsonErrorCode;
    }

    /**
     * Get the internal error message.
     *
     * @return string The internal error message.
     */
    public function jsonErrorMessage()
    {
        return $this->jsonErrorMessage;
    }

    private $path;
    private $jsonErrorCode;
    private $jsonErrorMessage;
}
