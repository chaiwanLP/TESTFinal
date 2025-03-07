<?php

declare(strict_types=1);

// Constant values for router
const ALLOW_METHODS = ['GET', 'POST'];
const INDEX_URI = '';
const INDEX_ROUNTE = 'home';


// Normalize URI
function normalizeUri(string $uri): string
{
    $uri = strtok($uri, '?');
    $uri = strtolower(trim($uri, '/'));
    return $uri == INDEX_URI ? INDEX_ROUNTE : $uri;
}
// function checkUrlImg(string $uri): bool
// {
//     $uri = strtolower(trim($uri, '/'));
//     return substr($uri, -4) === '.jpg';
// }

// Page not found function
function notFound(){
    http_response_code(404);
    echo "404 Not Found";
    exit;
}

function getFilePath(string $uri, string $method) : string {
    return ROUTE_DIR . '/' . normalizeUri($uri) . '_' . strtolower($method) . '.php' ;
}
function getFilePathImg(string $uri): string
{
    return IMAGE_DIR . '/' . basename(normalizeUri($uri));
}
// Router handler
function dispatch(string $uri, string $method) : void {
    $uri = normalizeUri($uri);
    if (checkUrlImg($uri)) {
            if (!in_array(strtoupper($method), ALLOW_METHODS)) {
                notFound();
            }
        $filePath = getFilePathImg($uri);
        header('Content-Type: image/jpeg');  // หรือสามารถเปลี่ยนเป็นประเภทไฟล์อื่น ๆ ตามที่รองรับ
        readfile($filePath);
        echo "Displaying image: " . $filePath;

    } else {
        if (!in_array(strtoupper($method), ALLOW_METHODS)) {
            notFound();
        }
        $filePath = getFilePath($uri, $method);
        if(file_exists($filePath)){
            include($filePath);
            return;
        } else {
            notFound();
        }
    }
}

function badRequest(string $message = 'Bad request'): void{
    http_response_code(400);
    echo $message;
    exit;
}






