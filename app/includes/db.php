<?php

function getConnection():mysqli
{
    $hostname = 'db';
    $dbName = 'event_management';
    $username = 'Final_Web_Project';
    $password = 'Final_Web_Project662025';
    $conn = new mysqli($hostname, $username, $password, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
// define('DATABASE_DIR', __DIR__ . '/../database');
require_once DATABASE_DIR . '/users.php';
require_once DATABASE_DIR . '/event.php';
require_once DATABASE_DIR . '/registration.php';
require_once DATABASE_DIR . '/event_images.php';
require_once DATABASE_DIR . '/attendance.php';
// 