<?php
namespace Poirot\Rpc\Client;

use Poirot\Core\AbstractOptions;

abstract class AbstractConnection implements ConnectionInterface
{
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
        if ($options == null)
            return;

        if (!$options instanceof AbstractOptions && !is_array($options))
            throw new \Exception(sprintf(
                'Constructor Except "Array" or Instanceof "AbstractOptions", but "%s" given.'
                , is_object($options) ? get_class($options) : gettype($options)
            ));

        $this->options()->from($options);
    }
}
