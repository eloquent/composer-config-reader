<?php

namespace Eloquent\Composer\Configuration\Element;

/**
 * Represents a standard repository.
 */
class Repository extends AbstractRepository
{
    /**
     * Construct a new repository.
     *
     * @param string                   $type    The repository type.
     * @param string|null              $uri     The repository URI.
     * @param array<string,mixed>|null $options The repository options.
     * @param mixed                    $rawData The raw data describing the repository.
     */
    public function __construct(
        $type,
        $uri = null,
        array $options = null,
        $rawData = null
    ) {
        parent::__construct(
            $type,
            $options,
            $rawData
        );

        $this->uri = $uri;
    }

    /**
     * Get the repository URI.
     *
     * @return string|null The repository URI.
     */
    public function uri()
    {
        return $this->uri;
    }

    private $uri;
}
