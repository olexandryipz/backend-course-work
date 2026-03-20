<?php
namespace App\Controllers;

use App\Core\Database;
use App\Models\Product;

class CheckoutController {

    public function index() {
        if (empty($_SESSION['cart'])) {
            header("Location: /cart");
            exit();
        }

        $title = "Оформлення замовлення";
        require_once __DIR__ . '/../Views/checkout.php';
    }

    public function process() {
        if (empty($_SESSION['cart'])) {
            header("Location: /");
            exit();
        }

        $name = $_POST['name'] ?? 'Клієнт';
        $phone = $_POST['phone'] ?? '';

        $totalPrice = 0;
        $cartProducts = [];

        foreach ($_SESSION['cart'] as $id => $qty) {
            $product = Product::getById($id);
            if ($product) {
                $totalPrice += $product['Price'] * $qty;
                $cartProducts[] = [
                    'id' => $id,
                    'qty' => $qty,
                    'price' => $product['Price']
                ];
            }
        }

        try {
            $db = Database::getInstance()->getConnection();

            $userId = $_SESSION['user_id'] ?? 1;
            $status = 'New';
            $createdAt = date('Y-m-d H:i:s');

            $stmt = $db->prepare("INSERT INTO Orders (UserId, TotalPrice, Status, CreatedAt) VALUES (?, ?, ?, ?)");
            $stmt->execute([$userId, $totalPrice, $status, $createdAt]);

            $orderId = $db->lastInsertId();

            $stmtItem = $db->prepare("INSERT INTO OrderItems (OrderId, ProductId, Quantity, Price) VALUES (?, ?, ?, ?)");

            foreach ($cartProducts as $item) {
                $stmtItem->execute([$orderId, $item['id'], $item['qty'], $item['price']]);
            }

            unset($_SESSION['cart']);

            $title = "Дякуємо за замовлення!";
            require_once __DIR__ . '/../Views/success.php';

        } catch (\Exception $e) {
            $title = "Помилка оформлення";

            require_once __DIR__ . '/../Views/partials/header.php';

            echo "<div style='text-align: center; padding: 50px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 600px; margin: auto;'>";
            echo "<h2 style='color:#dc3545;'>❌ Виникла помилка при оформленні замовлення</h2>";
            echo "<p style='font-size: 1.1em;'>На жаль, сталася технічна помилка на сервері. Будь ласка, спробуйте пізніше або зверніться до служби підтримки.</p>";
            echo "<br><a href='/cart' class='btn btn-blue'>Повернутися в кошик</a>";
            echo "</div>";

            require_once __DIR__ . '/../Views/partials/footer.php';
        }
    }
}