<?php
namespace Poirot\Rpc\Client;

use Poirot\Rpc\Request;
use Poirot\Rpc\Request\RequestInterface;

abstract class AbstractClient implements ClientInterface
{
    /**
     * Server Uri
     *
     * @var string
     */
    protected $serverUri;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Construct
     *
     * @param string $server Rpc Server Uri
     */
    public function __construct($server)
    {
        $this->setServerUri($server);
    }

    /**
     * Get Request Object Interface
     *
     * @return Request
     */
    public function request()
    {
        if (!$this->request)
            $this->request = new Request($this);

        return $this->request;
    }

    /**
     * Set Server Uri
     *
     * @param string $uri Server Uri
     *
     * @return $this
     */
    public function setServerUri($uri)
    {
        $this->serverUri = $uri;

        return $this;
    }

    /**
     * Get Server Uri
     *
     * @return string
     */
    public function getServerUri()
    {
        return $this->serverUri;
    }

    /**
     * Get Client Platform
     * - used by request to build params for
     *   rpc call and response
     *
     * @return PlatformInterface
     */
    abstract public function getPlatform();

    /**
     * Get Connection Adapter
     *
     * @return mixed
     */
    abstract public function getConnection();
}
