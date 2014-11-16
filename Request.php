<?php
namespace Poirot\Rpc;

use Poirot\Rpc\Client\ClientInterface;
use Poirot\Rpc\Request\Method;
use Poirot\Rpc\Request\RequestInterface;
use Poirot\Rpc\Request\Response;

class Request implements RequestInterface
{
    /**
     * Construct
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->setClient($client);
    }

    /**
     * Send Rpc Request
     *
     * @param mixed $method Rpc Method
     * @param mixed $params Rpc Params
     *
     * @return Response
     */
    public function call($method = null, $params = null)
    {
        // get connection from client
        // build method and params via platform
        // send request
        // build response via platform
        // return response
    }

    /**
     * Set Rpc Method
     *
     * @param $method Method
     * @return $this
     */
    public function setMethod($method)
    {
        // TODO: Implement setMethod() method.
    }

    /**
     * Get Method
     *
     * @return mixed
     */
    public function getMethod()
    {
        // TODO: Implement getMethod() method.
    }

    /**
     * Set Method Arguments(parameters)
     *
     * @param $params Method Parameters
     *
     * @return $this
     */
    public function setArgs($params)
    {
        // TODO: Implement setArgs() method.
    }

    /**
     * Get Method Arguments
     *
     * @return mixed
     */
    public function getArgs()
    {
        // TODO: Implement getArgs() method.
    }

    /**
     * Set Rpc Client
     *
     * @param ClientInterface $client Client
     *
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        // TODO: Implement setClient() method.
    }

    /**
     * Get Rpc Client
     *
     * @return ClientInterface
     */
    public function getClient()
    {
        // TODO: Implement getClient() method.
    }
}
 