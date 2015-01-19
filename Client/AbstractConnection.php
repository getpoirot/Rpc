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
        if ($options !== null)
            if ($options instanceof AbstractOptions)
                foreach($options->props()->writable as $opt)
                    $this->options()->{$opt} = $options->{$opt};
            elseif (is_array($options))
                $this->options()->fromArray($options);
            else
                throw new \Exception(sprintf(
                    'Constructor Except "Array" or Instanceof "AbstractOptions", but "%s" given.'
                    , is_object($options) ? get_class($options) : gettype($options)
                ));
    }
}
 