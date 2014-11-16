<?php
namespace Poirot\Rpc;

use Poirot\Rpc\Client\AbstractClient;
use Poirot\Rpc\Client\Connection\ConnectionInterface;
use Poirot\Rpc\Client\Json\JsonConnection;
use Poirot\Rpc\Client\Json\JsonPlatform;

class Json extends AbstractClient
{
    /**
     * @var JsonPlatform
     */
    protected $platform;

    /**
     * @var JsonConnection
     */
    protected $conn;

    /**
     * Get Client Platform
     * - used by request to build params for
     *   rpc call and response
     *
     * @return JsonPlatform
     */
    public function getPlatform()
    {
        ($this->platform) ?: $this->platform = new JsonPlatform();

        return $this->platform;
    }

    /**
     * Get Connection Adapter
     *
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        ($this->conn) ?: $this->conn = new JsonConnection();

        return $this->conn;
    }
}
