<?php
namespace Poirot\Rpc\Client;

use Poirot\Core\AbstractOptions;
use Poirot\Rpc\Request;

abstract class AbstractClient implements ClientInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Construct
     *
     * - pass connection options on construct
     *
     * @param Array|AbstractOptions $options Connection Options
     *
     * @throws \Exception
     */
    public function __construct($options = null)
    {
        if ($options !== null)
            if ($options instanceof AbstractOptions)
                foreach($options->props()->writable as $opt)
                    $this->connection()->options()->{$opt} = $options->{$opt};
            elseif (is_array($options))
                $this->connection()->options()->fromArray($options);
            else
                throw new \Exception(sprintf(
                    'Constructor Except "Array" or Instanceof "AbstractOptions", but "%s" given.'
                    , is_object($options) ? get_class($options) : gettype($options)
                ));
    }

    /**
     * Get Request Object Interface
     *
     * @return Request
     */
    function request()
    {
        if (!$this->request)
            $this->request = new Request($this);

        return $this->request;
    }
}
