<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h1>🛒 Ваш кошик</h1>

        <?php if (empty($cartItems)): ?>
            <p style="font-size: 1.2em;">Ваш кошик наразі порожній. 😢</p>
            <a href="/" class="btn btn-blue">Перейти до покупок</a>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr style="background: #f4f4f9; border-bottom: 2px solid #ddd;">
                    <th style="padding: 10px; text-align: left;">Товар</th>
                    <th style="padding: 10px; text-align: center;">Ціна</th>
                    <th style="padding: 10px; text-align: center;">Кількість</th>
                    <th style="padding: 10px; text-align: right;">Сума</th>
                </tr>

                <?php foreach ($cartItems as $item): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px 10px;">
                            <strong><?= htmlspecialchars($item['Name'] ?? 'Назва') ?></strong><br>
                            <small style="color: #666;">Розмір: <?= htmlspecialchars($item['Size'] ?? '-') ?></small>
                        </td>
                        <td style="padding: 10px; text-align: center;"><?= htmlspecialchars($item['Price']) ?> ₴</td>
                        <td style="padding: 10px; text-align: center; font-weight: bold;"><?= $item['quantity'] ?> шт.</td>
                        <td style="padding: 10px; text-align: right; font-weight: bold; color: #333;"><?= $item['subtotal'] ?> ₴</td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div style="text-align: right; font-size: 1.5em; margin-bottom: 20px;">
                Загальна сума: <strong style="color: #e44d26;"><?= $totalPrice ?> ₴</strong>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="/cart/clear" style="color: #dc3545; text-decoration: none; font-weight: bold;">🗑 Очистити кошик</a>

                <a href="/checkout" class="btn btn-green" style="font-size: 1.2em; padding: 12px 25px;">💳 Оформити замовлення</a>
            </div>
        <?php endif; ?>
    </div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>