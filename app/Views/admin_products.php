<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="margin-bottom: 20px; display: flex; gap: 15px; justify-content: space-between; align-items: center;">
        <div style="display: flex; gap: 15px;">
            <a href="/admin" class="btn btn-blue" style="background: #333;">Замовлення</a>
            <a href="/admin/products" class="btn btn-blue" style="background: #e44d26;">Товари на складі</a>
        </div>

        <a href="/admin/createProduct" class="btn btn-green" style="font-size: 1.1em; padding: 10px 20px;">+ Додати новий товар</a>
    </div>

    <div style="padding: 20px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h1 style="margin-top: 0;">Управління товарами</h1>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr style="background: #1a1a1a; color: white;">
                <th style="padding: 12px; text-align: left;">ID</th>
                <th style="padding: 12px; text-align: left;">Фото</th>
                <th style="padding: 12px; text-align: left;">Назва</th>
                <th style="padding: 12px; text-align: left;">Ціна</th>
                <th style="padding: 12px; text-align: center;">Залишок</th>
                <th style="padding: 12px; text-align: center;">Поповнити склад</th>
                <th style="padding: 12px; text-align: center;">Дії</th>
            </tr>

            <?php foreach ($products as $product): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;"><strong>#<?= $product['Id'] ?></strong></td>
                    <td style="padding: 12px;">
                        <img src="<?= htmlspecialchars($product['ImageUrl']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    </td>
                    <td style="padding: 12px; font-weight: bold;"><?= htmlspecialchars($product['Name']) ?></td>
                    <td style="padding: 12px; color: #e44d26; font-weight: bold;"><?= htmlspecialchars($product['Price']) ?> ₴</td>

                    <td style="padding: 12px; text-align: center;">
                    <span style="font-size: 1.2em; font-weight: bold; color: <?= $product['StockQuantity'] < 3 ? '#dc3545' : '#28a745' ?>;">
                        <?= $product['StockQuantity'] ?> шт.
                    </span>
                    </td>

                    <td style="padding: 12px; text-align: center;">
                        <form action="/admin/addStock/<?= $product['Id'] ?>" method="POST" style="display: flex; gap: 5px; justify-content: center;">
                            <input type="number" name="qty" min="1" required placeholder="+шт" style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                            <button type="submit" class="btn btn-blue" style="margin: 0; padding: 5px 10px;">➕</button>
                        </form>
                    </td>

                    <td style="padding: 12px; text-align: center;">
                        <div style="display: flex; gap: 5px; justify-content: center;">
                            <a href="/admin/editProduct/<?= $product['Id'] ?>" class="btn btn-blue" style="background: #ffc107; color: black; margin: 0; padding: 5px 10px;">Редагувати</a>

                            <a href="/admin/deleteProduct/<?= $product['Id'] ?>" class="btn" style="background: #dc3545; color: white; margin: 0; padding: 5px 10px;" onclick="return confirm('Ви впевнені, що хочете видалити цей товар?');">Видалити</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>