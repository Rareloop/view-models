<?php

namespace Rareloop\ViewModels;

/**
 * Container for view model parameters
 */
class ParameterBag implements \ArrayAccess, \IteratorAggregate
{
    protected $parameters = [];

    /**
     * Constructor.
     *
     * @param array $parameters An array of parameters
     */
    public function __construct(array $parameters = [])
    {
        foreach ($parameters as $key => $value) {
            $this->parameters[$key] = $value;
        }
    }

    /**
     * Returns a parameter value by name
     * @param  string $key The parameter name
     * @param  mixed $default The default value
     * @return mixed The value of the parameter, or the default value if it doesn't exist
     */
    public function get(string $key, $default = null)
    {
        return $this->parameters[$key] ?? $default;
    }

    /**
     * Returns true if the parameter is defined.
     *
     * @param  string  $key The parameter name
     * @return boolean  true if the parameter exists, false otherwise
     */
    public function has(string $key)
    {
        return array_key_exists($key, $this->parameters);
    }

    /**
     * Returns the parameters.
     *
     * @return array
     */
    public function all()
    {
        return $this->parameters;
    }

    /**
     * Get parameter values out of the bag via the property access magic method.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get(string $key)
    {
        return isset($this->parameters[$key]) ? $this->parameters[$key] : null;
    }

    /**
     * Check if a param exists in the bag via an isset() check on the property.
     *
     * @param string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->parameters[$key]);
    }

    /**
     * Disallow changing the value of params in the data bag via property access.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @throws \LogicException
     *
     * @return void
     */
    public function __set($key, $value)
    {
        throw new \LogicException('Modifying parameters is not permitted');
    }

    /**
     * Disallow unsetting params in the data bag via property access.
     *
     * @param string $key
     *
     * @throws \LogicException
     *
     * @return void
     */
    public function __unset($key)
    {
        throw new \LogicException('Modifying parameters is not permitted');
    }

    /**
     * Check if a param exists in the bag via an isset() and array access.
     *
     * @param string $key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->__isset($key);
    }

    /**
     * Get parameter values out of the bag via array access.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->__get($key);
    }

    /**
     * Disallow changing the value of params in the data bag via array access.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @throws \LogicException
     *
     * @return void
     */
    public function offsetSet($key, $value)
    {
        throw new \LogicException('Modifying parameters is not permitted');
    }

    /**
     * Disallow unsetting params in the data bag via array access.
     *
     * @param string $key
     *
     * @throws \LogicException
     *
     * @return void
     */
    public function offsetUnset($key)
    {
        throw new \LogicException('Modifying parameters is not permitted');
    }

    /**
     * IteratorAggregate for iterating over the object like an array.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->parameters);
    }
}
