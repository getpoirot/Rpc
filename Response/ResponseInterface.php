<?php
namespace Poirot\Rpc\Response;

interface ResponseInterface 
{
    /**
     * Get Response Body
     *
     * @return string
     */
    public function getBody();

    /**
     * Set Content Body
     *
     * @param string $content Content Body
     *
     * @return $this
     */
    public function setBody($content);
}
