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

class SupportInformation
{
    /**
     * @param string|null $email
     * @param string|null $issues
     * @param string|null $forum
     * @param string|null $wiki
     * @param string|null $irc
     * @param string|null $source
     * @param mixed $rawData
     */
    public function __construct(
        $email = null,
        $issues = null,
        $forum = null,
        $wiki = null,
        $irc = null,
        $source = null,
        $rawData = null
    ) {
        $this->email = $email;
        $this->issues = $issues;
        $this->forum = $forum;
        $this->wiki = $wiki;
        $this->irc = $irc;
        $this->source = $source;
        $this->rawData = $rawData;
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
    public function issues()
    {
        return $this->issues;
    }

    /**
     * @return string|null
     */
    public function forum()
    {
        return $this->forum;
    }

    /**
     * @return string|null
     */
    public function wiki()
    {
        return $this->wiki;
    }

    /**
     * @return string|null
     */
    public function irc()
    {
        return $this->irc;
    }

    /**
     * @return string|null
     */
    public function source()
    {
        return $this->source;
    }

    /**
     * @return mixed
     */
    public function rawData()
    {
        return $this->rawData;
    }

    private $email;
    private $issues;
    private $forum;
    private $wiki;
    private $irc;
    private $source;
    private $rawData;
}
