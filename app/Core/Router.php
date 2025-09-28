<?php
namespace App\Core;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * Register a GET route
     */
    public function get($path, $callback)
    {
        $path = rtrim($path, '/'); // normalize trailing slash
        $path = $path === '' ? '/' : $path;
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * Register a POST route
     */
    public function post($path, $callback)
    {
        $path = rtrim($path, '/'); // normalize trailing slash
        $path = $path === '' ? '/' : $path;
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * Resolve the incoming request
     */
    public function resolve($uri, $method)
    {
        $method = strtoupper($method);

        // Normalize the URI: remove query string and trailing slash
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/');
        if ($uri === '') {
            $uri = '/';
        }

        $callback = $this->routes[$method][$uri] ?? null;

        if (!$callback) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        // If callback is callable (closure)
        if (is_callable($callback)) {
            return call_user_func($callback);
        }

        // If callback is [ControllerClass, 'method']
        if (is_array($callback) && count($callback) === 2) {
            $controllerClass = $callback[0];
            $methodName = $callback[1];

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();

                if (method_exists($controller, $methodName)) {
                    return call_user_func([$controller, $methodName]);
                }
            }
        }

        http_response_code(500);
        echo "Invalid route callback";
    }
}