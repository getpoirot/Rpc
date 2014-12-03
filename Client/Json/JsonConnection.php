<?php
namespace Poirot\Rpc\Client\Json;

use Poirot\Collection\Entity;
use Poirot\Rpc\Client\ConnectionInterface;
use Poirot\Rpc\Exception\ExecuteException;

class JsonConnection implements ConnectionInterface
{
    /**
     * @var mixed Resource
     */
    protected $resource;

    /**
     * @var Entity Options
     */
    protected $options;

    /**
     * Get Prepared Resource Connection
     * - prepare resource on method access
     * - flag is connected
     *
     * @return mixed
     */
    public function getConnection()
    {
        $ch = $this->getOrigin();

        // ...
        (!$this->option()->has('connection_timeout')) ?:
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->option()->get('connection_timeout'));

        // ...
        (!$this->option()->has('user_agent')) ?:
            curl_setopt($ch, CURLOPT_USERAGENT, $this->option()->get('user_agent'));

        // ...
        $serverUri = $this->option()->get('server_uri');
        if (empty($serverUri))
            throw new \RuntimeException('"server_uri" is empty.');

        $serverUriPrs = parse_url($serverUri);
        if (!isset($serverUriPrs['host']))
            throw new \RuntimeException('Invalid "server_uri" Uri Format, Host not present.');

        if (isset($serverUriPrs['port'])) {
            curl_setopt($ch, CURLOPT_PORT, $serverUriPrs['port']);
            unset($serverUriPrs['port']);
        }

        curl_setopt($ch, CURLOPT_URL, $serverUri);

        // ...

        (!$this->option()->has('username')) ?:
            (!$this->option()->has('password')) ?:
            curl_setopt($ch, CURLOPT_USERPWD,
                $this->option()->get('username').':'.$this->option()->get('password')
            );

        return $ch;
    }

    /**
     * Execute Expression by send to server
     * and return result
     *
     * @param mixed $expr Expression
     *
     * @throws ExecuteException
     * @return mixed Server Result
     */
    public function exec($expr)
    {
        $ch = $this->getConnection();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $expr);

        if (!$result = curl_exec($ch))
            throw new ExecuteException(curl_error($ch), curl_errno($ch));

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
    public function getOrigin()
    {
        if ($this->resource)
            return $this->resource;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return response content as result

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
