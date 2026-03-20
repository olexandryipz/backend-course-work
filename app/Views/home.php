<?php require_once __DIR__ . '/partials/header.php'; ?>

    <h1><?= $title ?></h1>
    <p><?= $description ?></p>

    <p style="color: <?= $dbStatus['error'] ? 'red' : 'green' ?>; font-weight: bold;">
        <?= $dbStatus['message'] ?>
    </p>

    <hr>
    <h2>Наші товари</h2>

<?php if (!empty($products)): ?>
    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <h3><?= htmlspecialchars($product['Name'] ?? 'Товар без назви') ?></h3>
                <p class="product-price"><?= htmlspecialchars($product['Price'] ?? '0') ?> ₴</p>

                <a href="/product/show/<?= $product['Id'] ?? 1 ?>" class="btn btn-blue" style="display:block;">Детальніше</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Товарів поки немає.</p>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>