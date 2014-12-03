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
     * @var array Getter Namespaces Successive
     *            build from getter call
     */
    protected $namespaces_getter = array();

    /**
     * @var array Cached State of Namespace During Getters Call
     */
    protected $namespaces_cached = array();

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
        $this->namespaces_getter[] = $namespace;

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
        if (is_array($args[0])
            && array_values($args[0]) != $args[0]
            && count($args) == 1
        )
            // implement named parameters
            // ['minuend' => 42, 'subtrahend' => 23]
            $args = $args[0];

        $this->setArguments($args);

        if ($this->namespaces_getter)
            // if request build from getters set namespace and reset state
            $this->setNamespaceFromGetters($this->namespaces_getter);

        return '';
    }

    /**
     * Set Namespace From Getters
     * - save current namespace state
     * - reset getters namespace state
     * - set namespace to getters
     *
     * [php]
     * ->system->methods->Introspection(['x'=>1,])
     * [/php]
     *
     * @param array $gettersNamespaces Namespaces
     * @return $this
     */
    protected function setNamespaceFromGetters(array $gettersNamespaces)
    {
        ($this->namespaces_cached) ?: $this->namespaces_cached = $this->namespaces;
        $this->setNamespaces($gettersNamespaces);
        $this->namespaces_getter = array();

        return $this;
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
     * Get Namespace
     *
     * @return array
     */
    public function getNamespace()
    {
        return $this->namespaces;
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
        $namespaces   = $this->getNamespace();
        $namespaces[] = $namespace;

        $this->namespaces = $namespaces;

        return $this;
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
