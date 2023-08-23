<?php

/**
 * A simple container class for managing dependency injection.
 */
class Container
{
    /**
     * @var array An array to store bindings between abstracts and concretes.
     */
    private $bindings = [];

    /**
     * Initializes the container and binds itself for future resolutions.
     */
    public function __construct()
    {
        $this->bind(Container::class, $this);
    }

    /**
     * Bind an abstract to a concrete implementation or callback.
     *
     * @param string $abstract The abstract type or key.
     * @param mixed $concrete The concrete implementation, class name, or callback.
     * @return void
     * @throws Exception When the concrete is not a valid type.
     */
    public function bind($abstract, $concrete = null)
    {
        if ($concrete === null) {
            $concrete = $abstract;
        }

        if (!is_string($concrete) && !is_callable($concrete) && !is_object($concrete)) {
            throw new Exception("Invalid concrete type");
        }

        $this->bindings[$abstract] = $concrete;
    }

    /**
     * Resolve a binding by its abstract type, creating an instance if necessary.
     *
     * @param string $abstract The abstract type to resolve.
     * @return mixed The resolved instance or result of the callback.
     * @throws Exception When no binding is registered for the given abstract.
     */
    public function resolve($abstract)
    {
        if (isset($this->bindings[$abstract])) {
            $concrete = $this->bindings[$abstract];

            if (is_string($concrete)) {
                return $this->build($concrete);
            }

            if (is_callable($concrete)) {
                return $concrete($this);
            }

            if (is_object($concrete)) {
                return $concrete;
            }
        }

        throw new Exception("No binding registered for '$abstract'");
    }

    /**
     * Build an instance of a class by resolving its dependencies.
     *
     * @param string $concrete The class name to build.
     * @return object An instance of the resolved class.
     */
    private function build($concrete)
    {
        $reflection = new ReflectionClass($concrete);
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return new $concrete;
        }

        $dependencies = $this->resolveDependencies($constructor->getParameters());

        return $reflection->newInstanceArgs($dependencies);
    }

    /**
     * Resolve the dependencies of a constructor by recursively resolving them.
     *
     * @param ReflectionParameter[] $parameters The constructor parameters to resolve.
     * @return array An array of resolved dependencies.
     * @throws Exception When unable to resolve a dependency.
     */
    private function resolveDependencies($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependencyClass = $parameter->getClass();

            if ($dependencyClass) {
                $dependencies[] = $this->resolve($dependencyClass->name);
            } else {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Unable to resolve dependency for parameter '{$parameter->name}'");
                }
            }
        }

        return $dependencies;
    }
}
