<?php
namespace Poirot\Rpc\Client;

use Poirot\Core\AbstractOptions;
use Poirot\Rpc\Request;

abstract class AbstractClient implements ClientInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ConnectionInterface
     */
    protected $conn;

    /**
     * Construct
     *
     * @param ConnectionInterface $connection
     */
    function __construct(ConnectionInterface $connection = null)
    {
        if ($connection)
            $this->setConnection($connection);
    }

    /**
     * Set Connection
     *
     * @param ConnectionInterface $conn Connection Interface
     *
     * @return $this
     */
    public function setConnection(ConnectionInterface $conn)
    {
        $this->conn = $conn;

        return $this;
    }

    /**
     * Get Request Object Interface
     *
     * @return Request
     */
    function request()
    {
        if (!$this->request)
            $this->request = new Request($this);

        return $this->request;
    }
}
