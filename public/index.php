<?php
ob_start();

spl_autoload_register(function ($className) {
    $path = str_replace('App\\', '../app/', $className);
    $path = str_replace('\\', '/', $path) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

use App\Core\Router;

try {
    $router = new Router();
    $router->run();

} catch (Exception $e) {
    http_response_code(500);
    ob_clean();
    echo "<h1 style='color:red;'>Критична помилка сервера</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}

ob_end_flush();