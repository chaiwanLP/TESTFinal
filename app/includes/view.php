<?php

declare(strict_types=1);

function renderView(string $templates, array $data = []): void
{
    //มันไปเรียกไฟล์มา
    include TEMPLATES_DIR . '/header.php';
    include TEMPLATES_DIR . '/' . $templates . '.php';
    include TEMPLATES_DIR . '/footer.php';
}