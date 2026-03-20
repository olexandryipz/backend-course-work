<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h1 style="margin-top: 0;">Адмін-панель: Замовлення</h1>
        <p style="color: #666;">Тут відображаються всі замовлення ваших клієнтів.</p>

        <hr style="margin-bottom: 20px; border: 0; border-top: 1px solid #ddd;">

        <?php if (empty($orders)): ?>
            <p style="font-size: 1.1em; color: #dc3545;">Замовлень поки що немає.</p>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="background: #1a1a1a; color: white;">
                    <th style="padding: 12px; text-align: left;">№</th>
                    <th style="padding: 12px; text-align: left;">Клієнт</th>
                    <th style="padding: 12px; text-align: left;">Дата</th>
                    <th style="padding: 12px; text-align: right;">Сума</th>
                    <th style="padding: 12px; text-align: center;">Статус</th>
                </tr>

                <?php foreach ($orders as $order): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px;"><strong>#<?= $order['Id'] ?></strong></td>
                        <td style="padding: 12px;"><?= htmlspecialchars($order['UserName'] ?? 'Гість') ?></td>
                        <td style="padding: 12px; color: #666;"><?= date('d.m.Y H:i', strtotime($order['CreatedAt'])) ?></td>
                        <td style="padding: 12px; text-align: right; font-weight: bold; color: #e44d26;">
                            <?= htmlspecialchars($order['TotalPrice']) ?> ₴
                        </td>
                        <td style="padding: 12px; text-align: center;">
                        <span style="background: #28a745; color: white; padding: 5px 10px; border-radius: 12px; font-size: 0.85em;">
                            <?= htmlspecialchars($order['Status']) ?>
                        </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>