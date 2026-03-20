<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Інтернет-магазин' ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f9; color: #333; }
        header { background: #1a1a1a; color: #fff; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
        header a { color: #fff; text-decoration: none; font-weight: bold; font-size: 1.2em; }

        .nav-links { display: flex; align-items: center; gap: 20px; }
        .nav-links a { font-size: 1em; font-weight: normal; }
        .nav-links a:hover { color: #e44d26; }

        .user-menu { background: #333; padding: 8px 15px; border-radius: 20px; font-size: 0.9em; display: flex; gap: 15px; align-items: center; border: 1px solid #555; }
        .user-menu a { font-weight: bold; color: #4CAF50; }
        .user-menu a.logout { color: #dc3545; }

        .container { padding: 40px; max-width: 1000px; margin: auto; }
        .products-grid { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
        .product-card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; width: 200px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .product-price { color: #e44d26; font-size: 1.2em; font-weight: bold; }
        .btn { display: inline-block; margin-top: 10px; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-weight: bold; text-align: center; }
        .btn-blue { background: #0066cc; color: white; }
        .btn-green { background: #28a745; color: white; display: block; }
    </style>
</head>
<body>

<header>
    <a href="/">Clothing Store</a>
    <div class="nav-links">
        <a href="/">Головна</a>

        <?php
        $cartCount = 0;
        if (isset($_SESSION['cart'])) {
            $cartCount = array_sum($_SESSION['cart']);
        }
        ?>
        <a href="/cart">Кошик (<?= $cartCount ?>)</a>

        <div class="user-menu">
            <?php if (isset($_SESSION['user_id'])): ?>

                <?php if (isset($_SESSION['user_role']) && trim($_SESSION['user_role']) === 'Admin'): ?>
                    <a href="/admin" style="color: #ffc107;">Адмінка</a>
                <?php endif; ?>

                <span><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <a href="/auth/logout" class="logout">Вийти</a>
            <?php else: ?>
                <a href="/auth/login" style="color: #fff;">Увійти</a>
                <a href="/auth/register">Реєстрація</a>
            <?php endif; ?>
        </div>

    </div>
</header>

<div class="container">