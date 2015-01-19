<?php
namespace Poirot\Rpc;

use Poirot\Rpc\Client\AbstractClient;
use Poirot\Rpc\Client\ConnectionInterface;
use Poirot\Rpc\Client\Json\Connection\Options as JsonOptions;
use Poirot\Rpc\Client\Json\JsonConnection;
use Poirot\Rpc\Client\Json\JsonPlatform;

/**
 *
 * ~~~
 * $connection = new JsonConnection(
 *  # pass options as construct, the options will merge
 *  new Options(['server_uri' => '192.168.50.4:7080'])
 * );
 * $jsonRpc = new Json($connection);
 *
 * # ResponseInterface
 * $response = $jsonRpc->request()
 *  ->namespace
 *  ->method('arg1', ['arg2_array' => 'value'], $arg3);
 *
 *   For named parameters implementation
 *    $res = $jsonRpc->request()
 *      ->namespace(null, ['k'=>'v']);
 *      // "params": {"k": "v"}
 *
 * if (!$response->getException()) {
 *  $result = $response->getResult();
 *  $originResponseBody = $response->getOrigin();
 * } else
 *  throw $res->getException();
 *
 * ~~~
 */
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
     * Construct
     *
     * @param JsonConnection $connection
     */
    function __construct(JsonConnection $connection)
    {
        parent::__construct($connection);
    }

    /**
     * Get Client Platform
     * - used by request to build params for
     *   rpc call and response
     *
     * @return JsonPlatform
     */
    public function platform()
    {
        (isset($this->platform[$this->version]))
            ?: $this->platform[$this->version] = new JsonPlatform($this->version);

        return $this->platform[$this->version];
    }

    /**
     * Get Connection Adapter
     *
     * @return JsonConnection
     */
    public function connection()
    {
        ($this->conn) ?: $this->conn = new JsonConnection();

        return $this->conn;
    }
}
