<?php
namespace Poirot\Rpc;

use Poirot\Rpc\Response\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var mixed Response Result
     */
    protected $result;

    /**
     * @var string Origin Response Body
     */
    protected $body;

    /**
     * @var \Exception | null Exception
     */
    protected $exception = null;

    /**
     * Get Response Body
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set Result
     *
     * @param mixed $result Result
     *
     * @return $this
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Set Response Origin Content
     *
     * @param string $content Content Body
     *
     * @return $this
     */
    public function setOrigin($content)
    {
        $this->body = $content;

        return $this;
    }

    /**
     * Get Response Origin Body Content
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->body;
    }

    /**
     * Set Exception
     *
     * @param \Exception $exception Exception
     * @return $this
     */
    public function setException(\Exception $exception)
    {
        $this->exception = $exception;

        return $this;
    }

    /**
     * Get Exception
     *
     * @return \Exception | null
     */
    public function getException()
    {
        return $this->exception;
    }
}
