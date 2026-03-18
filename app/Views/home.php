<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }

        .products-grid { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
        .product-card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; width: 200px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .product-price { color: #e44d26; font-size: 1.2em; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1><?= $title ?></h1>
    <p><?= $description ?></p>

    <p class="<?= $dbStatus['error'] ? 'error' : 'success' ?>">
        <?= $dbStatus['message'] ?>
    </p>

    <hr>

    <h2>Наші товари</h2>

    <?php if (!empty($products)): ?>
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <h3><?= htmlspecialchars($product['Name'] ?? $product['Title'] ?? 'Товар без назви') ?></h3>
                    <p class="product-price"><?= htmlspecialchars($product['Price'] ?? '0') ?> ₴</p>
                    <p><?= htmlspecialchars($product['Description'] ?? 'Опис відсутній') ?></p>

                    <!-- ОСЬ НАША НОВА КНОПКА -->
                    <a href="/product/show/<?= $product['Id'] ?? $product['id'] ?? 1 ?>" style="display:block; margin-top:10px; color:#0066cc; text-decoration:none; font-weight:bold;">Детальніше →</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Товарів поки немає. Додайте їх у базу даних!</p>
    <?php endif; ?>

</div>

</body>
</html>