<?php
namespace Poirot\Rpc\Client\Json;

use Poirot\Rpc\Client\ConnectionInterface;
use Poirot\Rpc\Client\Json\Connection\Options;
use Poirot\Rpc\Exception\ExecuteException;

class JsonConnection implements ConnectionInterface
{
    /**
     * @var mixed Resource
     */
    protected $resource;

    /**
     * @var Options
     */
    protected $options;

    /**
     * ! public for accessible from Options
     *
     * @var bool
     */
    public $refreshConnection = false;

    /**
     * Get Prepared Resource Connection
     * - prepare resource on method access
     * - flag is connected
     *
     * @return mixed
     */
    public function getConnect()
    {
        $ch = $this->getOrigin();

        // ...
        (!$this->options()->getConnectionTimeout()) ?:
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->options()->getConnectionTimeout());

        // ...
        (!$this->options()->getUserAgent()) ?:
            curl_setopt($ch, CURLOPT_USERAGENT, $this->options()->getUserAgent());

        // ...
        $serverUri = $this->options()->getServerUri();
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

        /*(!$this->options()->has('username')) ?:
            (!$this->options()->has('password')) ?:
            curl_setopt($ch, CURLOPT_USERPWD,
                $this->options()->get('username').':'.$this->options()->get('password')
            );*/

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
        $ch = $this->getConnect();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $expr);

        if (!$result = curl_exec($ch))
            throw new ExecuteException(curl_error($ch), curl_errno($ch));

        return $result;
    }

    /**
     * Get Options
     *
     * @return Options
     */
    public function options()
    {
        ($this->options) ?:
            $this->options = new Options(['connection' => $this]); // inject connection

        return $this->options;
    }

    /**
     * Get Connection Engine Resource
     *
     * @return mixed
     */
    public function getOrigin()
    {
        if ($this->resource && !$this->refreshConnection)
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

        $this->resource = $ch;
        $this->refreshConnection = false;

        return $this->getOrigin();
    }
}
