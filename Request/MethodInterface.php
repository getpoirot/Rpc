<?php
namespace Poirot\Rpc\Request;

use Poirot\Collection\Entity;

interface MethodInterface
{
    /**
     * Set Namespaces prefix
     *
     * @param array $namespace Namespaces
     *
     * @return $this
     */
    public function setNamespaces(array $namespace);

    /**
     * Add Namespace
     *
     * @param string $namespace Namespace
     *
     * @return $this
     */
    public function addNamespace($namespace);

    /**
     * Get Namespace
     *
     * @return array
     */
    public function getNamespace();

    /**
     * Set Method Name
     *
     * @param string $method Method Name
     *
     * @return $this
     */
    public function setMethod($method);

    /**
     * Get Method Name
     *
     * @return string
     */
    public function getMethod();

    /**
     * Set Method Arguments
     *
     * @param array $args Arguments
     *
     * @return $this
     */
    public function setArguments(array $args);

    /**
     * Get Method Arguments
     *
     * @return Entity
     */
    public function getArguments();
}
