<?php
namespace Poirot\Rpc\Client\Platform;

use Poirot\Rpc\Request\MethodInterface;

interface PlatformInterface
{
    /**
     * Get Specific RPC Expression
     * to send to RPC Server
     *
     * @param MethodInterface $method Method Interface
     *
     * @return mixed
     */
    public function buildExpression(MethodInterface $method);
}
