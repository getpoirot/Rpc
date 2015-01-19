<?php
namespace Poirot\Rpc\Client;

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
    function getConnect();

    /**
     * Execute Expression by send to server
     * and return result
     *
     * @param mixed $expr Expression
     *
     * @throws ExecuteException
     * @return mixed Server Result
     */
    function exec($expr);

    /**
     * Get Connection Engine Resource
     *
     * @return mixed
     */
    function getOrigin();
}
