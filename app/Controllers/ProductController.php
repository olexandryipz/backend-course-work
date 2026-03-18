<?php
namespace App\Controllers;

use App\Models\Product;

class ProductController {
    public function show($id) {
        $product = Product::getById($id);

        if (!$product) {
            http_response_code(404);
            echo "<h1 style='color:red; text-align:center; margin-top:50px;'>Помилка 404: Товар не знайдено!</h1>";
            echo "<div style='text-align:center;'><a href='/'>Повернутися на головну</a></div>";
            return;
        }

        $title = $product['Name'] ?? 'Деталі товару';
        require_once __DIR__ . '/../Views/product.php';
    }
}