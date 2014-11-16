<?php
namespace Poirot\Rpc\Client\Json;

use Poirot\Collection\Entity;
use Poirot\Rpc\Client\Connection\ConnectionInterface;

class JsonConnection implements ConnectionInterface
{
    /**
     * @var string Server Uri
     */
    protected $serverUri;

    /**
     * @var mixed Resource
     */
    protected $resource;

    /**
     * @var Entity Options
     */
    protected $options;

    /**
     * @var boolean Is Connected?
     */
    protected $isConn = false;

    /**
     * Set Server Uri
     *
     * @param  mixed $uri Server Uri
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
     * @return mixed
     */
    public function getServerUri()
    {
        return $this->serverUri;
    }

    /**
     * Get Prepared Resource Connection
     * - prepare resource on method access
     * - flag is connected
     *
     * @return mixed
     */
    public function getConnection()
    {
        $ch = $this->getResource();

        curl_setopt($ch, CURLOPT_URL, $this->getServerUri());

        // set resource options
        (!$this->option()->has('username')) ?:
            (!$this->option()->has('password')) ?:
            curl_setopt($ch, CURLOPT_USERPWD,
                $this->option()->get('username').':'.$this->option()->get('password')
            );

        $this->isConn = true;

        return $ch;
    }

    /**
     * Is Connected
     *
     * @return boolean
     */
    public function isConnected()
    {
        return $this->isConn;
    }

    /**
     * Execute Expression by send to server
     * and return result
     *
     * @param mixed $expr Expression
     *
     * @return mixed Server Result
     */
    public function exec($expr)
    {
        $ch = $this->getConnection();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $expr);
        $result = curl_exec($ch);

        return $result;
    }

    /**
     * Get Options
     *
     * @return Entity
     */
    public function option()
    {
        ($this->options) ?: $this->options = new Entity();

        return $this->options;
    }

    /**
     * Get Connection Engine Resource
     *
     * @return mixed
     */
    public function getResource()
    {
        if ($this->resource)
            return $this->resource;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_USERAGENT, 'JSON-RPC PHP Client');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Connection: close',
            'Content-Type: application/json',
            'Accept: application/json'
        ));

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

        return $this->resource = $ch;
    }
}
 