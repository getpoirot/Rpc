<?php
namespace Poirot\Rpc\Client\Json;

use Poirot\Rpc\Client\Platform\PlatformInterface;
use Poirot\Rpc\Request\MethodInterface;
use Poirot\Rpc\Response;
use Poirot\Rpc\Response\ResponseInterface;

class JsonPlatform implements PlatformInterface
{
    /**
     * @var string Json-RPC Version
     */
    protected $ver = '2.0';

    /**
     * Get Specific RPC Expression
     * to send to RPC Server
     *
     * @param MethodInterface $method Method Interface
     *
     * @return mixed
     */
    public function buildExpression(MethodInterface $method)
    {
        if (version_compare($this->getVer(), '2.0') == -1 )
        {
            $expArray = array(
                'method'  => implode('.', $method->getNamespace()).$method->getMethod(),
                'params'  => $method->getArguments(),
                'id'      => uniqid()
            );
        } else {
            $expArray = array(
                'jsonrpc' => $this->getVer(),
                'method'  => implode('.', $method->getNamespace()).$method->getMethod(),
                'params'  => $method->getArguments(),
                'id'      => uniqid()
            );
        }

        return json_encode($expArray);
    }

    /**
     * Build Response from server result
     *
     * @param mixed $result Server Result
     *
     * @throws \Exception Throw Exceptions on Response Failed
     * @return ResponseInterface
     */
    public function buildResponse($result)
    {
        /*
         * {"jsonrpc": "2.0", "result": 19, "id": 4}
         * {"jsonrpc": "2.0", "error": {"code": -32601, "message": "Procedure not found."}, "id": 10}
         */
        $result = json_decode($result);

        $response = new Response();

        if (isset($result['result']))
            $response->setBody($result['result']);

        return $response;
    }

    /**
     * Set Version
     *
     * @param string $ver Version
     *
     * @return $this
     */
    public function setVer($ver)
    {
        $this->ver = $ver;

        return $this;
    }

    /**
     * Get Version
     *
     * @return string
     */
    public function getVer()
    {
        return $this->ver;
    }
}
 