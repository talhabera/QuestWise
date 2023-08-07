<?php

/**
 * This class handles the routing of the application.
 */
class Router
{
    protected static $routes = [];

    /**
     * Register a route
     *
     * @param string $url The route URL
     * @param mixed $action The route controller action
     * @return void
     */
    public static function get($url, $action)
    {
        self::$routes['GET'][$url] = $action;
    }

    /**
     * Register a route
     *
     * @param string $url The route URL
     * @param mixed $action The route controller action
     * @return void
     */
    public static function post($url, $action)
    {
        self::$routes['POST'][$url] = $action;
    }

    /**
     * Dispatch the router, creating the controller object and running the
     * action method.
     *
     * @param string $url The route URL
     * @param string $method The request HTTP method
     * @return void
     */
    public static function dispatch($url, $method)
    {
        $urlParts = explode('?', $url);
        $urlWithoutQuery = $urlParts[0];
        $params = [];

        if (array_key_exists($method, self::$routes)) {
            foreach (self::$routes[$method] as $route => $action) {
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
                    $actionName = $parts[1];

                    try {
                        require_once "../app/controllers/{$controllerName}.php";
                        $controller = new $controllerName();

                        // Use reflection to get the parameters of the action method
                        $reflector = new ReflectionMethod($controllerName, $actionName);
                        $methodParams = $reflector->getParameters();

                        $resolvedParams = [];
                        foreach ($methodParams as $param) {
                            $paramName = $param->getName();
                            $resolvedParams[] = $params[$paramName] ?? null;
                        }
                    } catch (Throwable $e) {
                        echo $e->getMessage();
                        // Handle 404 - Controller or action not found
                        echo "404 Not found.";
                        return;
                    }

                    try {
                        $controller->$actionName(...$resolvedParams);
                    } catch (Throwable $e) {
                        echo $e->getMessage();
                        // Handle 500 - Unhandled exception in controller action
                        echo "500 Internal Server Error";
                        return;
                    }

                    return; // Stop searching once a matching route is found
                }
            }
        }

        // Handle 404 - Route not found
        echo "404 Not found.";
    }
}
