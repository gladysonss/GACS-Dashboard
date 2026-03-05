<?php
// Database Configuration
// Use environment variables or fallback to local defaults
define('DB_HOST', getenv('DB_HOST') ?: 'db');
define('DB_USER', getenv('DB_USER') ?: 'user_gacs');
define('DB_PASS', getenv('DB_PASS') ?: 'secret_password');
define('DB_NAME', getenv('DB_NAME') ?: 'host_gacs');

// Create database connection
function getDBConnection()
{
    static $conn = null;

    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $conn->set_charset("utf8mb4");
    }

    return $conn;
}
