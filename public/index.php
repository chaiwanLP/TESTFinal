<?php

declare(strict_types=1);

error_reporting(E_ALL); 
ini_set('display_errors',1); 
ini_set('display_startup_errors',1);

// define('DATABASE_DIR', __DIR__ . '/../databases');
const DATABASE_DIR = __DIR__ . '/../app/databases';
const INCLUDES_DIR = __DIR__ . '/../app/includes';
const ROUTE_DIR = __DIR__ . '/../app/routes';
const TEMPLATES_DIR = __DIR__ . '/../app/templates';
const IMAGE_DIR = __DIR__ . '/../app/image';


session_start();

require_once INCLUDES_DIR . '/db.php';
require_once INCLUDES_DIR . '/router.php';
require_once INCLUDES_DIR . '/view.php';

const PUBLIC_ROUTES = ['/', '/login','/register'];

function checkUrlImg(string $uri): bool
{
    $uri = strtolower(trim($uri, '/'));
    return substr($uri, -4) === '.jpg'||substr($uri, -4) === '.png';
}

if (in_array(strtolower($_SERVER['REQUEST_URI']), PUBLIC_ROUTES) || checkUrlImg($_SERVER['REQUEST_URI'])) {
    dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    exit;
} elseif (isset($_SESSION['timestamp']) && time() - $_SESSION['timestamp'] < 900) {
    $unix_timestamp = time();
    $_SESSION['timestamp'] = $unix_timestamp;
    dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} else { 
    unset($_SESSION['timestamp']);
    echo "<script>alert('โปรดเข้าสู่ระบบก่อน'); window.location.href = '/';</script>";
    exit;
}
