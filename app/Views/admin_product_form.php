<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="margin-bottom: 20px;">
        <a href="/admin/products" class="btn btn-blue" style="background: #666;">⬅ Повернутися до списку</a>
    </div>

    <div style="padding: 30px; background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 600px; margin: auto;">

        <h1 style="margin-top: 0; margin-bottom: 20px; text-align: center;">
            <?= $product ? '✏ Редагувати товар' : '➕ Додати новий товар' ?>
        </h1>
        
        <form action="<?= $product ? '/admin/updateProduct/'.$product['Id'] : '/admin/storeProduct' ?>" method="POST" style="display: flex; flex-direction: column; gap: 15px;">

            <label style="font-weight: bold;">
                Назва товару:
                <input type="text" name="name" required value="<?= htmlspecialchars($product['Name'] ?? '') ?>" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </label>

            <label style="font-weight: bold;">
                Опис:
                <textarea name="description" required style="width: 100%; height: 100px; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; resize: vertical;"><?= htmlspecialchars($product['Description'] ?? '') ?></textarea>
            </label>

            <div style="display: flex; gap: 15px;">
                <label style="font-weight: bold; flex: 1;">
                    Ціна (₴):
                    <input type="number" step="0.01" min="1" name="price" required value="<?= htmlspecialchars($product['Price'] ?? '') ?>" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                </label>

                <label style="font-weight: bold; flex: 1;">
                    Залишок (шт):
                    <input type="number" min="0" name="stock_quantity" required value="<?= htmlspecialchars($product['StockQuantity'] ?? '10') ?>" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                </label>
            </div>

            <label style="font-weight: bold;">
                Посилання на фото (URL):
                <input type="url" name="image_url" placeholder="https://..." value="<?= htmlspecialchars($product['ImageUrl'] ?? '') ?>" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </label>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 10px 0;">

            <button type="submit" class="btn btn-green" style="font-size: 1.1em; padding: 12px;">
                <?= $product ? 'Зберегти зміни' : 'Створити товар' ?>
            </button>

        </form>
    </div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>