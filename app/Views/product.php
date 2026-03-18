<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 600px; margin: auto; }
        h1 { color: #333; margin-top: 0; }
        .price { color: #e44d26; font-size: 1.5em; font-weight: bold; margin: 20px 0; }
        .back-btn { display: inline-block; margin-top: 20px; text-decoration: none; color: white; background-color: #333; padding: 10px 20px; border-radius: 5px; }
        .back-btn:hover { background-color: #555; }
        .category-badge { display: inline-block; background: #eee; padding: 5px 10px; border-radius: 15px; font-size: 0.9em; color: #666; }
    </style>
</head>
<body>

<div class="container">
    <div class="category-badge">Розмір: <?= htmlspecialchars($product['Size'] ?? 'Універсальний') ?></div>

    <h1><?= htmlspecialchars($product['Name'] ?? 'Товар без назви') ?></h1>

    <div class="price"><?= htmlspecialchars($product['Price'] ?? '0') ?> ₴</div>

    <p><?= nl2br(htmlspecialchars($product['Description'] ?? 'Опис відсутній')) ?></p>

    <a href="/" class="back-btn">⬅ Повернутися до всіх товарів</a>
</div>

</body>
</html>