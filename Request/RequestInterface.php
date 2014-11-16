<?php
namespace Poirot\Rpc\Request;

use Poirot\Rpc\Client\ClientInterface;

interface RequestInterface
{
    /**
     * Send Rpc Request
     *
     * - get connection from client
     * - build method and params via platform
     * - send request
     * - build response via platform
     * - return response
     *
     * @param mixed $method Rpc Method
     * @param mixed $params Rpc Params
     *
     * @return Response
     */
    public function call($method = null, $params = null);

    /**
     * Set Rpc Method
     *
     * @param $method Method
     * @return $this
     */
    public function setMethod($method);

    /**
     * Get Method
     *
     * @return mixed
     */
    public function getMethod();

    /**
     * Set Method Arguments(parameters)
     *
     * @param $params Method Parameters
     *
     * @return $this
     */
    public function setArgs($params);

    /**
     * Get Method Arguments
     *
     * @return mixed
     */
    public function getArgs();

    /**
     * Set Rpc Client
     *
     * @param ClientInterface $client Client
     *
     * @return $this
     */
    public function setClient(ClientInterface $client);

    /**
     * Get Rpc Client
     *
     * @return ClientInterface
     */
    public function getClient();
}
