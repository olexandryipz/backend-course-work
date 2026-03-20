<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <span style="background: #eee; padding: 5px 10px; border-radius: 15px; font-size: 0.9em; color: #666;">
        Розмір: <?= htmlspecialchars($product['Size'] ?? 'Універсальний') ?>
    </span>

        <h1 style="margin-top: 10px;"><?= htmlspecialchars($product['Name'] ?? 'Товар без назви') ?></h1>

        <div class="product-price" style="font-size: 1.8em; margin: 20px 0;">
            <?= htmlspecialchars($product['Price'] ?? '0') ?> ₴
        </div>

        <p style="line-height: 1.6;"><?= nl2br(htmlspecialchars($product['Description'] ?? 'Опис відсутній')) ?></p>

        <a href="/cart/add/<?= $product['Id'] ?? 1 ?>" class="btn btn-green" style="width: 200px;">🛒 Додати в кошик</a>

        <br>
        <a href="/" style="color: #666; text-decoration: none;">⬅ Повернутися до товарів</a>
    </div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>