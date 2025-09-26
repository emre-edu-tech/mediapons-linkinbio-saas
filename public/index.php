<?php

require __DIR__ . '/../vendor/autoload.php';
// Now all classes under App\ namespace will be autoloaded automatically

use App\Core\Router;

// Initialize the router
$router = new Router();

// Define some test routes
$router->get('/', function() {
    echo 'Welcome to Link-in-Bio SaaS';
});

$router->get('/about', function() {
    echo 'This is the about page';
});

$router->post('/submit', function() {
    echo 'Form submitted successfully via POST!';
});

// Run router
$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);