<?php

/*
 * This file is part of the Composer configuration reader package.
 *
 * Copyright © 2012 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eloquent\Composer\Configuration\Domain;

class PackageRepository extends AbstractRepository
{
    /**
     * @param array                    $packageData
     * @param array<string,mixed>|null $options
     * @param mixed                    $rawData
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
     * @return array
     */
    public function packageData()
    {
        return $this->packageData;
    }

    private $packageData;
}
