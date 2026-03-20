<?php
namespace App\Controllers;

use App\Core\Database;
use App\Models\Product;
use PDO;

class CheckoutController {

    public function index() {
        if (empty($_SESSION['cart'])) {
            header("Location: /cart");
            exit();
        }

        if (empty($_SESSION['user_id'])) {
            header("Location: /auth/login");
            exit();
        }

        $title = "Оформлення замовлення";
        require_once __DIR__ . '/../Views/checkout.php';
    }

    public function process() {
        if (empty($_SESSION['cart']) || empty($_SESSION['user_id'])) {
            header("Location: /");
            exit();
        }

        $name = $_POST['name'] ?? $_SESSION['user_name'] ?? 'Клієнт';
        $phone = $_POST['phone'] ?? 'не вказано';

        $totalPrice = 0;
        $cartProducts = [];
        $errors = [];

        foreach ($_SESSION['cart'] as $id => $qty) {
            $product = Product::getById($id);
            if ($product) {
                if (isset($product['StockQuantity']) && $product['StockQuantity'] < $qty) {
                    $errors[] = "Товару '{$product['Name']}' залишилося лише {$product['StockQuantity']} шт.";
                } else {
                    $totalPrice += $product['Price'] * $qty;
                    $cartProducts[] = [
                        'id' => $id,
                        'qty' => $qty,
                        'price' => $product['Price']
                    ];
                }
            }
        }

        if (!empty($errors)) {
            $title = "Помилка наявності";
            require_once __DIR__ . '/../Views/partials/header.php';
            echo "<div style='text-align: center; padding: 50px; background: white; border-radius: 8px; max-width: 600px; margin: auto;'>";
            echo "<h2 style='color:#dc3545;'>Недостатньо товару на складі</h2>";
            foreach ($errors as $error) { echo "<p>{$error}</p>"; }
            echo "<br><a href='/cart' class='btn btn-blue'>Повернутися в кошик</a>";
            echo "</div>";
            require_once __DIR__ . '/../Views/partials/footer.php';
            return;
        }

        try {
            $db = Database::getInstance()->getConnection();

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $db->beginTransaction();

            $userId = $_SESSION['user_id'];
            $status = 'New';
            $createdAt = date('Y-m-d H:i:s');

            $stmt = $db->prepare("INSERT INTO Orders (UserId, TotalPrice, Status, CreatedAt) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userId, $totalPrice, $status, $createdAt]);

            $orderId = $db->lastInsertId();

            $stmtItem = $db->prepare("INSERT INTO OrderItems (OrderId, ProductId, Quantity, Price) VALUES (?, ?, ?, ?)");

            $stmtUpdateStock = $db->prepare("UPDATE Products SET StockQuantity = StockQuantity - :qty WHERE Id = :id");

            foreach ($cartProducts as $item) {
                $stmtItem->execute([$orderId, $item['id'], $item['qty'], $item['price']]);

                $stmtUpdateStock->bindValue(':qty', (int)$item['qty'], PDO::PARAM_INT);
                $stmtUpdateStock->bindValue(':id', (int)$item['id'], PDO::PARAM_INT);
                $stmtUpdateStock->execute();
            }

            $db->commit();
            unset($_SESSION['cart']);

            $title = "Дякуємо за замовлення!";
            require_once __DIR__ . '/../Views/success.php';

        } catch (\Exception $e) {
            if (isset($db)) { $db->rollBack(); }

            $title = "Помилка оформлення";
            require_once __DIR__ . '/../Views/partials/header.php';
            echo "<div style='text-align: center; padding: 50px; background: white; border-radius: 8px; max-width: 600px; margin: auto;'>";
            echo "<h2 style='color:#dc3545;'>Виникла помилка при оформленні замовлення</h2>";
            echo "<p>Деталі помилки (для розробника): " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "<br><a href='/cart' class='btn btn-blue'>Повернутися в кошик</a>";
            echo "</div>";
            require_once __DIR__ . '/../Views/partials/footer.php';
        }
    }
}