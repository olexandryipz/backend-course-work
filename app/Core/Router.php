<?php
namespace App\Core;

class Router {
    public function run() {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $segments = $uri === '' ? [] : explode('/', $uri);

        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';

        $methodName = !empty($segments[1]) ? $segments[1] : 'index';

        $controllerClass = "\\App\\Controllers\\" . $controllerName;

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $methodName)) {
                $params = array_slice($segments, 2);
                call_user_func_array([$controller, $methodName], $params);
            } else {
                $this->abort(404, "Метод не знайдено.");
            }
        } else {
            $this->abort(404, "Сторінку не знайдено.");
        }
    }

    private function abort($code, $message) {
        http_response_code($code);
        ob_clean();
        echo "<h1 style='color:red;'>Помилка $code</h1>";
        echo "<p>$message</p>";
        echo "<a href='/'>Повернутися на головну</a>";
        exit();
    }
}