<?php
namespace App\Controllers;

use App\Core\Database;

class HomeController {
    public function index() {
        echo "<h1>Головна сторінка</h1>";
        echo "<p>Ласкаво просимо до нашого інтернет-магазину одягу, який працює на MVC!</p>";

        try {
            $db = Database::getInstance()->getConnection();
            if ($db) {
                echo "<p style='color:green; font-weight:bold;'>База даних успішно підключена до нашого контролера!</p>";
            }
        } catch (\Exception $e) {
            echo "<p style='color:red;'>❌ Помилка БД: " . $e->getMessage() . "</p>";
        }
    }
}