<?php
namespace Poirot\Rpc;

use Poirot\Rpc\Client\AbstractClient;
use Poirot\Rpc\Client\Platform\PlatformInterface;

class Json extends AbstractClient
{
    /**
     * Get Client Platform
     * - used by request to build params for
     *   rpc call and response
     *
     * @return PlatformInterface
     */
    public function getPlatform()
    {
        // TODO: Implement getPlatform() method.
    }

    /**
     * Get Connection Adapter
     *
     * @return mixed
     */
    public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }
}
