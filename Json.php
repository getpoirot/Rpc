<?php
namespace Poirot\Rpc;

use Poirot\Rpc\Client\AbstractClient;
use Poirot\Rpc\Client\ClientInterface;
use Poirot\Rpc\Client\ConnectionInterface;
use Poirot\Rpc\Client\Json\JsonConnection;
use Poirot\Rpc\Client\Json\JsonPlatform;

class Json extends AbstractClient
{
    const JSONRPC_VER1 = '1.0';
    const JSONRPC_VER2 = '2.0';

    public $version = self::JSONRPC_VER2;

    /**
     * @var JsonPlatform
     */
    protected $platform = [];

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
        (isset($this->platform[$this->version]))
            ?: $this->platform[$this->version] = new JsonPlatform($this->version);

        return $this->platform[$this->version];
    }

    /**
     * Set Connection
     *
     * @param ConnectionInterface $conn Connection Interface
     *
     * @return $this
     */
    public function setConnection($conn)
    {
        $this->conn = $conn;

        return $this;
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
