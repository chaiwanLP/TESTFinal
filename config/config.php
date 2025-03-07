<?php

$dotenv = parse_ini_file(__DIR__ . '/../.env');

define('DB_HOST', $dotenv['DB_HOST']);
define('DB_NAME', $dotenv['DB_NAME']);
define('DB_USER', $dotenv['DB_USER']);
define('DB_PASS', $dotenv['DB_PASS']);

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>
