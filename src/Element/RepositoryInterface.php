<?php

namespace Eloquent\Composer\Configuration\Element;

/**
 * The interface implemented by repositories.
 */
interface RepositoryInterface
{
    /**
     * Get the repository type.
     *
     * @return string The repository type.
     */
    public function type();
}
