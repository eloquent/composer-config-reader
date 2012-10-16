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

class Author
{
    /**
     * @param string $name
     * @param string|null $email
     * @param string|null $homepage
     * @param string|null $role
     * @param mixed $rawData
     */
    public function __construct(
        $name,
        $email = null,
        $homepage = null,
        $role = null,
        $rawData = null
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->homepage = $homepage;
        $this->role = $role;
        $this->rawData = $rawData;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function homepage()
    {
        return $this->homepage;
    }

    /**
     * @return string|null
     */
    public function role()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function rawData()
    {
        return $this->rawData;
    }

    private $name;
    private $email;
    private $homepage;
    private $role;
    private $rawData;
}
