<?php
namespace Poirot\Rpc\Client\Platform;

use Poirot\Rpc\Request\MethodInterface;

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
 