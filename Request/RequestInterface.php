<?php
namespace Poirot\Rpc\Request;

use Poirot\Rpc\Client\ClientInterface;
use Poirot\Rpc\Response;

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
     * @param MethodInterface $method Rpc Method
     *
     * @return Response
     */
    public function call(MethodInterface $method = null);

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
