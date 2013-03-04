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

final class InvalidJSONException extends RuntimeException implements ConfigurationException
{
    /**
     * @param string         $path
     * @param integer        $jsonErrorCode
     * @param Exception|null $previous
     */
    public function __construct($path, $jsonErrorCode, Exception $previous = null)
    {
        $this->path = $path;
        $this->jsonErrorCode = $jsonErrorCode;
        switch ($jsonErrorCode) {
            case JSON_ERROR_DEPTH:
                $this->jsonErrorMessage = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $this->jsonErrorMessage = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $this->jsonErrorMessage = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $this->jsonErrorMessage = 'Syntax error.';
                break;
            case JSON_ERROR_UTF8:
                $this->jsonErrorMessage = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
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
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * @return integer
     */
    public function jsonErrorCode()
    {
        return $this->jsonErrorCode;
    }

    /**
     * @return string
     */
    public function jsonErrorMessage()
    {
        return $this->jsonErrorMessage;
    }

    private $path;
    private $jsonErrorCode;
    private $jsonErrorMessage;
}
