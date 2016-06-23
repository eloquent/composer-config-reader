<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2016 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Element;

/**
 * A repository that indicates whether the Packagist repository is enabled or
 * disabled.
 */
class PackagistRepository implements RepositoryInterface
{
    /**
     * Construct a new Packagist repository.
     *
     * @param bool  $isEnabled True if packagist is enabled.
     * @param mixed $rawData   The raw data describing the repository.
     */
    public function __construct($isEnabled, $rawData = null)
    {
        $this->isEnabled = $isEnabled;
        $this->rawData = $rawData;
    }

    /**
     * Returns true if the Packagist repository is enabled.
     *
     * @return bool True if enabled.
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * Get the repository type.
     *
     * @return string The repository type.
     */
    public function type()
    {
        return '';
    }

    /**
     * Get the raw repository data.
     *
     * @return mixed The raw repository data.
     */
    public function rawData()
    {
        return $this->rawData;
    }

    private $isEnabled;
    private $rawData;
}
