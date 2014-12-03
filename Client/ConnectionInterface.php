<?php
namespace Poirot\Rpc\Client;

use Poirot\Collection\Entity;
use Poirot\Rpc\Exception\ExecuteException;

interface ConnectionInterface
{
    /**
     * Get Prepared Resource Connection
     * - prepare resource on method access
     * - flag is connected
     *
     * @return mixed
     */
    public function getConnection();

    /**
     * Execute Expression by send to server
     * and return result
     *
     * @param mixed $expr Expression
     *
     * @throws ExecuteException
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
    public function getOrigin();
}
