<?php
namespace Poirot\Rpc\Client;

interface ClientInterface 
{
    /**
     * Get Request Object Interface
     *
     * @return RequestInterface
     */
    public function request();

    /**
     * Get Client Platform
     * - used by request to build params for
     *   rpc call and response
     *
     * @return ClientPlatformInterface
     */
    public function getPlatform();

    /**
     * Set Connection Adapter
     *
     * @param $connection Connection Adapter
     * @return $this
     */
    public function setConnection($connection);

    /**
     * Get Connection Adapter
     *
     * @return mixed
     */
    public function getConnection();
}
