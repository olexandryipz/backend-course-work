<?php
namespace App\Controllers;

use App\Models\Product;

class HomeController {
    public function index() {
        $title = "Головна - Clothing Store";
        $products = Product::getAll();

        require_once __DIR__ . '/../Views/home.php';
    }
}