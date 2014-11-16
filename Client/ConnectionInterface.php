<?php
namespace Poirot\Rpc\Client\Connection;

use Poirot\Collection\Entity;

interface ConnectionInterface
{
    /**
     * Set Server Uri
     *
     * @param  mixed $uri Server Uri
     *
     * @return $this
     */
    public function setServerUri($uri);

    /**
     * Get Server Uri
     *
     * @return mixed
     */
    public function getServerUri();

    /**
     * Get Prepared Resource Connection
     * - prepare resource on method access
     * - flag is connected
     *
     * @return mixed
     */
    public function getConnection();

    /**
     * Is Connected
     *
     * @return boolean
     */
    public function isConnected();

    /**
     * Execute Expression by send to server
     * and return result
     *
     * @param mixed $expr Expression
     *
     * @return mixed Server Result
     */
    public function exec($expr);

    /**
     * Get Options
     *
     * @return Entity
     */
    public function option();

    /**
     * Get Connection Engine Resource
     *
     * @return mixed
     */
    public function getResource();
}
