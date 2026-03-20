<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="text-align: center; background: white; padding: 50px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 600px; margin: auto;">
        <h1 style="color: #28a745;">🎉 Замовлення успішно оформлено!</h1>
        <p style="font-size: 1.2em;">Дякуємо, <b><?= htmlspecialchars($name) ?></b>! Ми зв'яжемося з вами найближчим часом за номером <b><?= htmlspecialchars($phone) ?></b>.</p>

        <div style="background: #f4f4f9; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p style="margin: 0; font-size: 1.1em;">Номер вашого замовлення: <b>#<?= $orderId ?></b></p>
        </div>

        <br>
        <a href="/" class="btn btn-blue">Повернутися на головну</a>
    </div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>