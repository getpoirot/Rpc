<?php
namespace Poirot\Rpc\Client;

use Poirot\Rpc\Request\MethodInterface;
use Poirot\Rpc\Response\ResponseInterface;

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

    /**
     * Build Response from server result
     *
     * @param mixed $result Server Result
     *
     * @throws \Exception Throw Exceptions on Response Failed
     * @return ResponseInterface
     */
    public function buildResponse($result);
}
