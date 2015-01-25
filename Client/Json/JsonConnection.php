<?php
namespace Poirot\Rpc\Client\Json;

use Poirot\Core\AbstractOptions;
use Poirot\Rpc\Client\AbstractConnection;
use Poirot\Rpc\Client\Json\Connection\Options as JsonOptions;
use Poirot\Rpc\Exception\ExecuteException;

class JsonConnection extends AbstractConnection
{
    /**
     * @var mixed Resource
     */
    protected $resource;

    /**
     * @var JsonOptions
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
     * @return JsonOptions
     */
    public function options()
    {
        ($this->options) ?:
            $this->options = self::optionsIns();

        $this->options->setConnection($this);

        return $this->options;
    }

    /**
     * Get An Bare Options Instance
     *
     * ! it used on easy access to options instance
     *   before constructing class
     *   [php]
     *      $opt = Filesystem::optionsIns();
     *      $opt->setSomeOption('value');
     *
     *      $class = new Filesystem($opt);
     *   [/php]
     *
     * @return JsonOptions
     */
    static function optionsIns()
    {
        return new JsonOptions();
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
