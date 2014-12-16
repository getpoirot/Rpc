<?php
namespace Poirot\Rpc\Client\Json\Connection;

use Poirot\Core\AbstractOptions;

class Options extends AbstractOptions
{
    protected $serverUri;

    protected $connectionTimeout;

    protected $userAgent = 'JSON-RPC PHP Client';

    /**
     * @return mixed
     */
    public function getServerUri()
    {
        return $this->serverUri;
    }

    /**
     * @param mixed $serverUri
     */
    public function setServerUri($serverUri)
    {
        $this->serverUri = $serverUri;
    }

    /**
     * @return mixed
     */
    public function getConnectionTimeout()
    {
        return $this->connectionTimeout;
    }

    /**
     * @param mixed $connectionTimeout
     */
    public function setConnectionTimeout($connectionTimeout)
    {
        $this->connectionTimeout = $connectionTimeout;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }
}
