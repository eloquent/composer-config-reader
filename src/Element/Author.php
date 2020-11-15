<?php

namespace Eloquent\Composer\Configuration\Element;

/**
 * Represents an author.
 */
class Author
{
    /**
     * Construct a new author.
     *
     * @param string      $name     The author's name.
     * @param string|null $email    The author's email address.
     * @param string|null $homepage The URI of the author's home page.
     * @param string|null $role     The author's role.
     * @param mixed       $rawData  The raw data describing the author.
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
     * Get the author's name.
     *
     * @return string The author's name.
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get the author's email address.
     *
     * @return string|null The author's email address.
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Get the URI of the author's home page.
     *
     * @return string|null The URI of the author's home page.
     */
    public function homepage()
    {
        return $this->homepage;
    }

    /**
     * Get the author's role.
     *
     * @return string|null The author's role.
     */
    public function role()
    {
        return $this->role;
    }

    /**
     * Get the raw author data.
     *
     * @return mixed The raw author data.
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
