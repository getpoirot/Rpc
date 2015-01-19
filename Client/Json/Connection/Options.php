<?php
namespace Poirot\Rpc\Client\Json\Connection;

use Poirot\Core\AbstractOptions;
use Poirot\Rpc\Client\Json\JsonConnection;

class Options extends AbstractOptions
{
    /**
     * ! Injected Connection To Refresh
     *   Connection Resource
     *
     * @var JsonConnection
     */
    protected $connection;

    protected $serverUri;
    protected $connectionTimeout;
    protected $userAgent = 'JSON-RPC PHP Client';

    /**
     * @return mixed
     */
    function getServerUri()
    {
        return $this->serverUri;
    }

    /**
     * ! refresh connection
     *
     * @param mixed $serverUri
     */
    function setServerUri($serverUri)
    {
        $this->serverUri = $serverUri;

        $this->connection->refreshConnection = true;
    }

    /**
     * @return mixed
     */
    function getConnectionTimeout()
    {
        return $this->connectionTimeout;
    }

    /**
     * @param mixed $connectionTimeout
     */
    function setConnectionTimeout($connectionTimeout)
    {
        $this->connectionTimeout = $connectionTimeout;
    }

    /**
     * @return string
     */
    function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     */
    function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * Inject Connection
     *
     * @param JsonConnection $connection
     */
    function setConnection(JsonConnection $connection)
    {
        $this->connection = $connection;
    }
}
