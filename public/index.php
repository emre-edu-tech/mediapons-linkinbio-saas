<?php

require __DIR__ . '/../vendor/autoload.php';
// Now all classes under App\ namespace will be autoloaded automatically

use App\Core\Router;
use App\Controllers\HomeController;

// Initialize the router
$router = new Router();

// Define some test routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);

// Run router
$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);