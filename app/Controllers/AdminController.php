<?php
namespace App\Controllers;

use App\Models\Order;

class AdminController {

    public function index() {
        if (empty($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Admin') {
            header("Location: /");
            exit();
        }

        $orders = Order::getAllWithUsers();
        $title = "Панель адміністратора";
        require_once __DIR__ . '/../Views/admin.php';
    }
}