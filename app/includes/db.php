<?php
$host = 'dpg-cv5jd4i3esus73emdqn0-a.oregon-postgres.render.com';
$dbname = 'event_management_ebim';
$user = 'final_web_project';
$password = 'jJTAEJ1WJf2wRV4c7TvF8owsEDEMd372';

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>