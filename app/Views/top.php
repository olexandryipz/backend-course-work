<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: #e44d26; margin-bottom: 5px;">ТОП-5: Хіти продажів</h1>
        <p style="color: #666;">Найпопулярніші товари, які наші клієнти купують найчастіше!</p>
    </div>

<?php if (!empty($topProducts) && $topProducts[0]['TotalSold'] > 0): ?>
    <div class="products-grid">
        <?php foreach ($topProducts as $topProduct): ?>
            <?php if ($topProduct['TotalSold'] > 0): ?>
                <div class="product-card top-card">
                    <div class="bestseller-badge">
                        Купили <?= htmlspecialchars($topProduct['TotalSold']) ?> разів!
                    </div>
                    <img src="<?= htmlspecialchars($topProduct['ImageUrl'] ?? 'https://via.placeholder.com/300x200?text=Немає+фото') ?>" alt="<?= htmlspecialchars($topProduct['Name']) ?>" class="product-image">

                    <div class="product-details">
                        <h3 style="margin-top: 0; font-size: 1.1em;"><?= htmlspecialchars($topProduct['Name']) ?></h3>
                        <p class="product-price" style="margin-bottom: 5px;"><?= htmlspecialchars($topProduct['Price']) ?> ₴</p>
                        <p style="font-size: 0.85em; color: #666; margin-top: 0; margin-bottom: 15px;">
                            В наявності: <strong><?= htmlspecialchars($topProduct['StockQuantity'] ?? '0') ?> шт.</strong>
                        </p>
                        <a href="/product/show/<?= $topProduct['Id'] ?>" class="btn btn-blue" style="display:block; text-align: center;">Детальніше</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div style="text-align: center; padding: 50px;">
        <p style="font-size: 1.2em; color: #666;">Поки що немає проданих товарів для формування рейтингу.</p>
        <a href="/" class="btn btn-blue">Перейти до покупок</a>
    </div>
<?php endif; ?>

    <style>
        .products-grid { display: flex; gap: 25px; flex-wrap: wrap; justify-content: center; }
        .product-card { border: 1px solid #eee; padding: 0; border-radius: 8px; width: calc(25% - 19px); background: #fff; overflow: hidden; transition: 0.3s; position: relative; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0,0,0,0.15); }
        .top-card { border: 2px solid #ffc107; box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2); }
        .bestseller-badge { background: #ffc107; color: #000; text-align: center; font-weight: bold; padding: 8px; font-size: 1em; }
        .product-image { width: 100%; height: 250px; object-fit: cover; border-bottom: 1px solid #eee; }
        .product-details { padding: 15px; }
    </style>

<?php require_once __DIR__ . '/partials/footer.php'; ?>