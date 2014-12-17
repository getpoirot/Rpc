<?php
namespace Poirot\Rpc;

use Poirot\Rpc\Client\ClientInterface;
use Poirot\Rpc\Request\Method;
use Poirot\Rpc\Request\MethodInterface;
use Poirot\Rpc\Request\RequestInterface;
use Poirot\Rpc\Response\ResponseInterface;

class Request extends Method implements
    RequestInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

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
     * @return ResponseInterface
     */
    public function call(MethodInterface $method = null)
    {
        ($method) ?: $this;

        $client   = $this->getClient();
        $platform = $client->platform();

        $expr     = $platform->buildExpression($method);

        $result   = $client->connection()
            ->exec($expr);

        $response = $platform->buildResponse($result);

        return $response;
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
        $this->client = $client;

        return $this;
    }

    /**
     * Get Rpc Client
     *
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }
}
 