<?php
namespace App\Controllers;

use App\Models\Product;

class TopController {
    public function index() {
        $title = "ТОП-5 Хітів продажу";

        $topProducts = Product::getTopSelling(5);

        require_once __DIR__ . '/../Views/top.php';
    }
}