<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    /**
     * Singleton instance
     * @var Database|null
     */
    private static $instance = null;

    /**
     * PDO Connection
     * @var PDO
     */
    private $connection;

    /**
     * Private constructor to prevent direct creation
     * @param array $config
     */
    private function __construct($config) {
        try {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                $config['host'],
                $config['name']
            );

            $this->connection = new PDO($dsn, $config['user'], $config['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);

        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    /**
     * Get the singleton instance of Database
     * @param array $config
     * @return Database
     */
    public static function getInstance($config) {
        if(self::$instance === null) {
            self::$instance = new Database($config);
        }
        return self::$instance;
    }

    /**
     * Get PDO connection
     */
    public function getConnection() {
        return $this->connection;
    }
}