<?php
namespace Poirot\Rpc\Client;

use Poirot\Core\Entity;
use Poirot\Core\Interfaces\OptionsProviderInterface;
use Poirot\Rpc\Exception\ExecuteException;

interface ConnectionInterface extends OptionsProviderInterface
{
    /**
     * Get Prepared Resource Connection
     * - prepare resource with options
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
     * Get Connection Engine Resource
     *
     * @return mixed
     */
    public function getOrigin();
}
