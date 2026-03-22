<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\Review;

class ProductController {

    public function show($id) {
        $product = Product::getById($id);
        if (!$product) {
            header("Location: /");
            exit();
        }

        $title = $product['Name'];

        $reviews = Review::getByProductId($id);

        require_once __DIR__ . '/../Views/product.php';
    }

    public function addReview($id) {
        if (empty($_SESSION['user_id'])) {
            header("Location: /auth/login");
            exit();
        }

        $rating = $_POST['rating'] ?? 5;
        $comment = trim($_POST['comment'] ?? '');

        if (!empty($comment)) {
            Review::add($id, $_SESSION['user_id'], $rating, $comment);
        }

        header("Location: /product/show/" . $id);
        exit();
    }
}