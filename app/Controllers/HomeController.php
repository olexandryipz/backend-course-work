<?php
namespace App\Controllers;

use App\Core\Database;
use App\Models\Product;

class HomeController {
    public function index() {
        $title = "Головна сторінка";
        $description = "Ласкаво просимо до нашого інтернет-магазину одягу! Це чистий MVC.";

        $dbStatus = ['error' => false, 'message' => ''];
        $products = [];

        try {
            $db = Database::getInstance()->getConnection();
            if ($db) {
                $dbStatus['message'] = "База даних успішно підключена!";
                $products = Product::getAll();
            }
        } catch (\Exception $e) {
            $dbStatus['error'] = true;
            $dbStatus['message'] = "Помилка БД: " . $e->getMessage();
        }

        require_once __DIR__ . '/../Views/home.php';
    }
}