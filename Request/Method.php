<?php
namespace Poirot\Rpc\Request;

use Poirot\Collection\Entity;

class Method implements MethodInterface
{
    /**
     * @var array Method Namespaces
     */
    protected $namespaces = array();

    /**
     * @var string Method
     */
    protected $method;

    /**
     * @var array Method Arguments
     */
    protected $args = array();

    /**
     * Get to next successive namespace
     *
     * @param string $namespace
     *
     * @return $this
     */
    public function __get($namespace)
    {
        $this->addNamespace($namespace);

        return $this;
    }

    /**
     * Call a method in this namespace.
     *
     * @param string $method
     * @param array  $args
     *
     * @return null
     */
    public function __call($method, $args)
    {
        $this->setMethod($method);
        $args = (count($args) > 1 || empty($args)) ? $args : $args[0];

        $this->setArguments($args);

        return '';
    }

    /**
     * Set Namespaces prefix
     * - use without argument to clear namespaces
     *
     * @param array $namespaces Namespaces
     *
     * @return $this
     */
    public function setNamespaces(array $namespaces = array())
    {
        $this->namespaces = $namespaces;

        return $this;
    }

    /**
     * Add Namespace
     *
     * @param string $namespace Namespace
     *
     * @return $this
     */
    public function addNamespace($namespace)
    {
        $this->namespaces[] = $namespace;

        return $this;
    }

    /**
     * Get Namespace
     *
     * @return array
     */
    public function getNamespace()
    {
        return $this->namespaces;
    }

    /**
     * Set Method Name
     *
     * @param string $method Method Name
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get Method Name
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set Method Arguments
     *
     * @param array $args Arguments
     *
     * @return $this
     */
    public function setArguments(array $args)
    {
        $this->args = $args;

        return $this;
    }

    /**
     * Get Method Arguments
     *
     * @return Entity
     */
    public function getArguments()
    {
        return $this->args;
    }
}
