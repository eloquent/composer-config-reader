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
 * Represents a package repository.
 */
class PackageRepository extends AbstractRepository
{
    /**
     * Construct a new package repository.
     *
     * @param array                    $packageData The raw package data.
     * @param array<string,mixed>|null $options     The repository options.
     * @param mixed                    $rawData     The raw data describing the repository.
     */
    public function __construct(
        array $packageData,
        array $options = null,
        $rawData = null
    ) {
        parent::__construct(
            'package',
            $options,
            $rawData
        );

        $this->packageData = $packageData;
    }

    /**
     * Get the raw package data.
     *
     * @return array The raw package data.
     */
    public function packageData()
    {
        return $this->packageData;
    }

    private $packageData;
}
