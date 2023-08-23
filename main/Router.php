<?php

/**
 * This class handles the routing of the application.
 */
class Router
{
    protected $routes = [];
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Register a route
     *
     * @param string $url The route URL
     * @param mixed $controller The route controller
     * @param string $action The route controller action
     * @return void
     */
    public function get($url, $controller, $action)
    {
        $this->routes['GET'][$url] = $controller . '@' . $action;
        $this->container->bind($controller);
    }

    /**
     * Register a route
     *
     * @param string $url The route URL
     * @param mixed $action The route controller action
     * @return void
     */
    public function post($url, $controller, $action)
    {
        $this->routes['POST'][$url] = $controller . '@' . $action;
        $this->container->bind($controller);
    }

    /**
     * Dispatch the router, creating the controller object and running the
     * action method.
     *
     * @param string $url The route URL
     * @param string $method The request HTTP method
     * @return void
     */
    public function dispatch($url, $method)
    {
        $urlParts = explode('?', $url);
        $urlWithoutQuery = $urlParts[0];
        $params = [];
        if (array_key_exists($method, $this->routes)) {
            foreach ($this->routes[$method] as $route => $action) {
                // Convert the route to a regular expression pattern
                $pattern = '#^' . preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_-]*)\}#', '(?<$1>[^/]+)', $route) . '$#';
                
                // Check if the URL matches the pattern
                if (preg_match($pattern, $urlWithoutQuery, $matches)) {
                    // Extract the captured route parameters
                    $params = $matches;
                    unset($params[0]);

                    // Append the query string parameters to the $params array
                    $queryString = $urlParts[1] ?? '';
                    parse_str($queryString, $queryArray);
                    $params = array_merge($params, $queryArray);

                    $parts = explode('@', $action);
                    $controllerName = $parts[0];
                    $actionName = $parts[1] . 'Action';

                    try {
                        $controller = $this->container->resolve($controllerName);

                        // Use reflection to get the parameters of the action method
                        $reflector = new ReflectionMethod($controllerName, $actionName);
                        $methodParams = $reflector->getParameters();

                        $resolvedParams = [];
                        foreach ($methodParams as $param) {
                            $paramName = $param->getName();
                            $resolvedParams[] = $params[$paramName] ?? null;
                        }
                    } catch (Throwable $e) {
                        $error = $e->getMessage();
                        // Handle 404 - Controller or action not found
                        require_once '../app/views/errors/notfound.php';
                        exit();
                    }

                    try {
                        $controller->$actionName(...$resolvedParams);
                    } catch (Throwable $e) {
                        $error = $e->getMessage();
                        // Handle 500 - Unhandled exception in controller action
                        require_once '../app/views/errors/servererror.php';
                        exit();
                    }

                    return; // Stop searching once a matching route is found
                }
            }
        }
        
        // Handle 404 - Route not found
        require_once '../app/views/errors/notfound.php';
        exit();
    }
}
