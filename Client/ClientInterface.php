<?php
namespace Poirot\Rpc\Client;

use Poirot\Rpc\Request\RequestInterface;

interface ClientInterface
{
    /**
     * Set Connection
     *
     * @param ConnectionInterface $conn Connection Interface
     *
     * @return $this
     */
    public function setConnection($conn);

    /**
     * Get Connection Adapter
     *
     * @return mixed
     */
    public function getConnection();

    /**
     * Get Request Object Interface
     *
     * - inject client to request object
     *   * to get platform to build response/expression
     *   * to get connection to exec expression
     *
     * @return RequestInterface
     */
    public function request();

    /**
     * Get Client Platform
     * - used by request to build params for
     *   rpc call and response
     *
     * @return PlatformInterface
     */
    public function getPlatform();
}
