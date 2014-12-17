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
     * @param AbstractOptions $options Connection Options
     */
    public function __construct(AbstractOptions $options = null)
    {
        if ($options !== null) {
            foreach($options->props()->writable as $prop)
                // Merge Options
                $this->connection()->options()->{$prop} = $options->{$prop};
        }
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
