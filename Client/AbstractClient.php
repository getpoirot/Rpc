<?php
namespace Poirot\Rpc\Client;

use Poirot\Rpc\Request;
use Poirot\Rpc\Request\RequestInterface;
use Zend\Db\Adapter\Driver\ConnectionInterface;

abstract class AbstractClient implements ClientInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Construct
     *
     * @param ConnectionInterface|string $connection Rpc Server Uri
     */
    public function __construct($connection)
    {
        if ($connection !== null) {
            if (is_string($connection)) {
                $conn = $this->getConnection();
                if ($conn instanceof ConnectionInterface)
                    $conn->options()->setServerUri($connection);
                else
                    throw new \RuntimeException(sprintf(
                        'Invalid Connection "%s"'
                        , is_object($conn) ? get_class($conn) : gettype($conn)
                    ));
            }

            elseif ($connection instanceof ConnectionInterface)
                $this->setConnection($connection);
            else throw new \InvalidArgumentException(
                'Connection must be a serverUri string or Instanceof "ConnectionInterface"'
                . sprintf('but "%s" given.', is_object($connection) ? get_class($connection) : gettype($connection))
            );
        }
    }

    /**
     * Get Request Object Interface
     *
     * @return Request
     */
    public function request()
    {
        if (!$this->request)
            $this->request = new Request($this);

        return $this->request;
    }
}
