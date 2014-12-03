<?php
namespace Poirot\Rpc\Response;

interface ResponseInterface 
{
    /**
     * Get Response Result
     *
     * @return mixed
     */
    public function getResult();

    /**
     * Set Result
     *
     * @param mixed $result Result
     *
     * @return $this
     */
    public function setResult($result);

    /**
     * Set Response Origin Content
     *
     * @param string $content Content Body
     *
     * @return $this
     */
    public function setOrigin($content);

    /**
     * Get Response Origin Body Content
     *
     * @return string
     */
    public function getOrigin();

    /**
     * Set Exception
     *
     * @param \Exception $exception Exception
     * @return $this
     */
    public function setException(\Exception $exception);

    /**
     * Get Exception
     *
     * @return \Exception | null
     */
    public function getException();
}
