<?php
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
}

if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}

if (!defined('DB_PASS')) {
    define('DB_PASS', '');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'bookingsystemdb');

    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST; // Driver settes her

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        echo "Server er under vedlikeholding";
        error_log($e);
    }
