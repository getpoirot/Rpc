<?php
namespace Poirot\Rpc\Client;

use Poirot\Rpc\Request\RequestInterface;

interface ClientInterface
{
    /**
     * Get Request Object Interface
     *
     * @return RequestInterface
     */
    public function request();

    /**
     * Set Server Uri
     *
     * @param string $uri Server Uri
     *
     * @return $this
     */
    public function setServerUri($uri);

    /**
     * Get Server Uri
     *
     * @return string
     */
    public function getServerUri();

    /**
     * Get Client Platform
     * - used by request to build params for
     *   rpc call and response
     *
     * @return PlatformInterface
     */
    public function getPlatform();

    /**
     * Get Connection Adapter
     *
     * @return mixed
     */
    public function getConnection();
}
