<?php

namespace App\Core;

use Exception;

class Router {
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * Register a GET route
     */
    public function get(string $path, callable $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * Register a POST route
     */
    public function post(string $path, callable $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * Resolve the current request
     */
    public function resolve(string $requestUri, string $requestMethod)
    {
        $path = parse_url($requestUri, PHP_URL_PATH) ?? '/';
        $method = strtoupper($requestMethod);

        $callback = $this->routes[$method][$path] ?? null;

        if(!$callback) {
            http_response_code(404);
            echo '404 not Found';
            return;
        }

        // If callback is callable, execute it!
        if(is_callable($callback)) {
            return call_user_func(($callback));
        }

        // If callback is [ControllerClass, 'method']
        if(is_array($callback) && count($callback) === 2) {
            [$class, $method] = $callback;
            if(class_exists($class)) {
                $controller = new $class();
                return call_user_func([$controller, $method]);
            }
        }

        throw new Exception('Invalid route callback');
    }
}