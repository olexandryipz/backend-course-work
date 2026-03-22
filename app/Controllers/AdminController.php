<?php
namespace App\Controllers;

use App\Models\Product;
use App\Core\Database;
use PDO;

class AdminController {

    private function checkAdmin() {
        if (empty($_SESSION['user_id']) || trim($_SESSION['user_role']) !== 'Admin') {
            header("Location: /");
            exit();
        }
    }

    public function index() {
        $this->checkAdmin();
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("
            SELECT o.*, u.Name as UserName 
            FROM Orders o 
            LEFT JOIN Users u ON o.UserId = u.Id 
            ORDER BY o.CreatedAt DESC
        ");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $title = "Адмін-панель: Замовлення";
        require_once __DIR__ . '/../Views/admin.php';
    }

    public function products() {
        $this->checkAdmin();
        $products = Product::getAll();
        $title = "Адмін-панель: Товари";
        require_once __DIR__ . '/../Views/admin_products.php';
    }

    public function addStock($id) {
        $this->checkAdmin();
        $qty = (int)($_POST['qty'] ?? 0);
        if ($qty > 0) {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("UPDATE Products SET StockQuantity = StockQuantity + ? WHERE Id = ?");
            $stmt->execute([$qty, $id]);
        }
        header("Location: /admin/products");
        exit();
    }

    public function createProduct() {
        $this->checkAdmin();
        $title = "Додати новий товар";
        $product = null;
        require_once __DIR__ . '/../Views/admin_product_form.php';
    }

    public function storeProduct() {
        $this->checkAdmin();

        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $imageUrl = trim($_POST['image_url'] ?? '');
        $stock = (int)($_POST['stock_quantity'] ?? 10);

        if (!empty($name) && $price > 0) {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("INSERT INTO Products (Name, Description, Price, ImageUrl, StockQuantity) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $description, $price, $imageUrl, $stock]);
        }

        header("Location: /admin/products");
        exit();
    }

    public function editProduct($id) {
        $this->checkAdmin();

        $product = Product::getById($id);
        if (!$product) {
            header("Location: /admin/products");
            exit();
        }

        $title = "Редагувати товар";
        require_once __DIR__ . '/../Views/admin_product_form.php';
    }

    public function updateProduct($id) {
        $this->checkAdmin();

        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $imageUrl = trim($_POST['image_url'] ?? '');
        $stock = (int)($_POST['stock_quantity'] ?? 0);

        if (!empty($name) && $price > 0) {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("UPDATE Products SET Name = ?, Description = ?, Price = ?, ImageUrl = ?, StockQuantity = ? WHERE Id = ?");
            $stmt->execute([$name, $description, $price, $imageUrl, $stock, $id]);
        }

        header("Location: /admin/products");
        exit();
    }

    public function deleteProduct($id) {
        $this->checkAdmin();

        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM Products WHERE Id = ?");
        $stmt->execute([$id]);

        header("Location: /admin/products");
        exit();
    }
}