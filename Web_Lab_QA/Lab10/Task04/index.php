<?php
// Place in public/index.php; point the web server document root to public/.
$path=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$routes=[
    '/' => fn()=>print('Home page'),
    '/products' => fn()=>print('Products page'),
    '/health' => fn()=>print('OK'),
];
if(isset($routes[$path])) { $routes[$path](); }
else { http_response_code(404); require __DIR__.'/../views/404.php'; }
