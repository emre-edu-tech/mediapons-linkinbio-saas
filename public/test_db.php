<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$config = require __DIR__ . '/../config/config.php';

// Get DB Instance
$db1 = Database::getInstance($config['db']);
$db2 = Database::getInstance($config['db']);

// should be true
var_dump($db1 === $db2);

// test if connection works (should show PDO object)
$pdo = $db1->getConnection();
var_dump($pdo instanceof PDO);

// Run a simple query
$query = $pdo->query("SELECT NOW() as `current_time`");
$result = $query->fetch();
var_dump($result);