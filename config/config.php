<?php

use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return [
    'db' => [
        'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',      // or 'localhost'
        'name' => $_ENV['DB_NAME'] ?? 'linkinbiodb',    // replace with your database name
        'user' => $_ENV['DB_USER'] ?? 'root',           // database username
        'pass' => $_ENV['DB_PASS'] ?? '',               // database password
    ],
    'app' => [
        'env' => $_ENV['APP_ENV'] ?? 'development',      // development or production
        'debug' => ($_ENV['APP_DEBUG'] ?? 'false') === 'true',
    ]
];