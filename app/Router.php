<?php

class Router
{
    protected static $routes = [];

    public static function get($url, $action)
    {
        self::$routes['GET'][$url] = $action;
    }

    public static function post($url, $action)
    {
        self::$routes['POST'][$url] = $action;
    }

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
                    if (is_callable($action)) {
                        $action();
                    } elseif (is_string($action)) {
                        // Extract the captured route parameters
                        $params = $matches;
                        unset($params[0]);

                        // Append the query string parameters to the $params array
                        $queryString = $urlParts[1] ?? '';
                        parse_str($queryString, $queryArray);
                        $params = array_merge($params, $queryArray);

                        // Append the request body as an object to the $params array
                        $input = self::getRequestBody();
                        $params['input'] = $input;

                        $parts = explode('@', $action);
                        $controllerName = $parts[0];
                        $actionName = $parts[1];

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

                        $controller->$actionName(...$resolvedParams);
                    }

                    return; // Stop searching once a matching route is found
                }
            }
        }

        // Handle 404 - Route not found
        echo "{$method} {$url}<br>Route not found.";
    }

    private static function getRequestBody(): object|null
    {
        // Read the raw input from the request
        $rawData = file_get_contents('php://input');
        var_dump($rawData);

        // Assuming the content is in JSON format, decode it into an object
        $dataObject = json_decode($rawData);

        // If decoding fails, you can return null or throw an exception
        if ($dataObject === null && json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        return $dataObject;
    }
}
