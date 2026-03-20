<?php require_once __DIR__ . '/partials/header.php'; ?>

    <h1>Наші товари</h1>
    <p>Ласкаво просимо до нашого інтернет-магазину одягу! Ми підготували для вас 8 найкращих новинок сезону.</p>

    <hr style="margin-bottom: 30px; border: 0; border-top: 1px solid #ddd;">

<?php if (!empty($products)): ?>
    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?= htmlspecialchars($product['ImageUrl'] ?? 'https://via.placeholder.com/300x200?text=Немає+фото') ?>" alt="<?= htmlspecialchars($product['Name'] ?? 'Товар') ?>" class="product-image">

                <div class="product-details">
                    <h3 style="margin-top: 0; font-size: 1.1em;"><?= htmlspecialchars($product['Name'] ?? 'Товар без назви') ?></h3>
                    <p class="product-price"><?= htmlspecialchars($product['Price'] ?? '0') ?> ₴</p>

                    <a href="/product/show/<?= $product['Id'] ?? 1 ?>" class="btn btn-blue" style="display:block;">Детальніше</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Товарів поки немає.</p>
<?php endif; ?>

    <style>
        .products-grid { display: flex; gap: 25px; flex-wrap: wrap; margin-top: 20px; }
        .product-card { border: 1px solid #eee; padding: 0; border-radius: 8px; width: calc(25% - 19px); background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.05); overflow: hidden; transition: 0.3s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0,0,0,0.15); }
        .product-image { width: 100%; height: 250px; object-fit: cover; border-bottom: 1px solid #eee; }
        .product-details { padding: 15px; }
    </style>

<?php require_once __DIR__ . '/partials/footer.php'; ?>