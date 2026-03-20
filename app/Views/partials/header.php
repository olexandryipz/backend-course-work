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
        .nav-links a { margin-left: 20px; font-size: 1em; font-weight: normal; }
        .nav-links a:hover { color: #e44d26; }
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
    <a href="/">👕 Clothing Store</a>
    <div class="nav-links">
        <a href="/">Головна</a>
        <?php
        $cartCount = 0;
        if (isset($_SESSION['cart'])) {
            $cartCount = array_sum($_SESSION['cart']);
        }
        ?>
        <a href="/cart">🛒 Кошик (<?= $cartCount ?>)</a>
    </div>
</header>

<div class="container">