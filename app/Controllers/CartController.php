<?php
namespace App\Controllers;

use App\Models\Product;

class CartController {

    public function index() {
        $title = "Мій кошик";
        $cartItems = [];
        $totalPrice = 0;

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $product = Product::getById($productId);

                if ($product) {
                    $product['quantity'] = $quantity;
                    $product['subtotal'] = $product['Price'] * $quantity;
                    $totalPrice += $product['subtotal'];
                    $cartItems[] = $product;
                }
            }
        }

        require_once __DIR__ . '/../Views/cart.php';
    }

    public function add($id) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }

        header("Location: /cart");
        exit();
    }

    public function clear() {
        unset($_SESSION['cart']);
        header("Location: /cart");
        exit();
    }
}