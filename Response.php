<?php
namespace Poirot\Rpc;

use Poirot\Rpc\Response\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var string Response Body
     */
    protected $body;

    /**
     * Get Response Body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set Content Body
     *
     * @param string $content Content Body
     *
     * @return $this
     */
    public function setBody($content)
    {
        $this->body = $content;

        return $this;
    }
}
