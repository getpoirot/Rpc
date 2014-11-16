<?php
namespace Poirot\Rpc;

use Poirot\Collection\Entity;
use Poirot\Rpc\Client\ClientInterface;
use Poirot\Rpc\Request\Method;
use Poirot\Rpc\Request\MethodInterface;
use Poirot\Rpc\Request\RequestInterface;

class Request extends Method implements
    RequestInterface
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
     * Call a method in this namespace.
     *
     * @param string $method
     * @param array  $args
     *
     * @return null
     */
    public function __call($method, $args)
    {
        parent::__call($method, $args);

        return $this->call($this);
    }

    /**
     * Send Rpc Request
     *
     * @param MethodInterface $method Rpc Method
     *
     * @return Response
     */
    public function call(MethodInterface $method = null)
    {
        ($method) ?: $this;
        
        // get connection from client
        // build method and params via platform
        // send request
        // build response via platform
        // return response
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
 