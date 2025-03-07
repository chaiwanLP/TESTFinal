<?php

function getConnection():mysqli
{
    $hostname = 'dpg-cv5jd4i3esus73emdqn0-a';
    $dbName = 'event_management_ebim';
    $username = 'final_web_project';
    $password = 'jJTAEJ1WJf2wRV4c7TvF8owsEDEMd372';
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