<?php

namespace Eloquent\Composer\Configuration\Element;

/**
 * Represents the support information for a package.
 */
class SupportInformation
{
    /**
     * Construct a new support information configuration.
     *
     * @param string|null $email   The support email address.
     * @param string|null $issues  The URI of the issue tracker.
     * @param string|null $forum   The URI of the forum.
     * @param string|null $wiki    The URI of the wiki.
     * @param string|null $irc     The URI of the IRC channel.
     * @param string|null $source  The URI to the source code.
     * @param mixed       $rawData The raw data describing the support information.
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
     * Get the support email address.
     *
     * @return string|null The support email address.
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Get the URI of the issue tracker.
     *
     * @return string|null The URI of the issue tracker.
     */
    public function issues()
    {
        return $this->issues;
    }

    /**
     * Get the URI of the forum.
     *
     * @return string|null The URI of the forum.
     */
    public function forum()
    {
        return $this->forum;
    }

    /**
     * Get the URI of the wiki.
     *
     * @return string|null The URI of the wiki.
     */
    public function wiki()
    {
        return $this->wiki;
    }

    /**
     * Get the URI of the IRC channel.
     *
     * @return string|null The URI of the IRC channel.
     */
    public function irc()
    {
        return $this->irc;
    }

    /**
     * Get the URI to the source code.
     *
     * @return string|null The URI to the source code.
     */
    public function source()
    {
        return $this->source;
    }

    /**
     * Get the raw configuration data.
     *
     * @return mixed The raw configuration data.
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
