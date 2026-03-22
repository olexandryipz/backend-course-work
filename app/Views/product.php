<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="display: flex; gap: 30px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 30px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px;">
            <img src="<?= htmlspecialchars($product['ImageUrl'] ?? 'https://via.placeholder.com/400x400?text=Немає+фото') ?>" alt="<?= htmlspecialchars($product['Name']) ?>" style="width: 100%; border-radius: 8px; object-fit: cover;">
        </div>
        <div style="flex: 2; min-width: 300px;">
            <h1 style="margin-top: 0;"><?= htmlspecialchars($product['Name']) ?></h1>
            <p style="font-size: 1.5em; color: #e44d26; font-weight: bold; margin-bottom: 5px;"><?= htmlspecialchars($product['Price']) ?> ₴</p>
            <p style="color: #666; margin-top: 0; margin-bottom: 20px;">В наявності: <strong><?= htmlspecialchars($product['StockQuantity'] ?? '0') ?> шт.</strong></p>

            <p style="line-height: 1.6;"><?= htmlspecialchars($product['Description'] ?? 'Чудовий вибір для вашого гардеробу. Висока якість та комфорт.') ?></p>

            <form action="/cart/add/<?= $product['Id'] ?>" method="POST" style="margin-top: 30px;">
                <button type="submit" class="btn btn-blue" style="font-size: 1.1em; padding: 12px 25px; border: none; cursor: pointer;">🛒 Додати в кошик</button>
            </form>
        </div>
    </div>

    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; border-bottom: 2px solid #ddd; padding-bottom: 10px;">💬 Відгуки покупців</h2>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="/product/addReview/<?= $product['Id'] ?>" method="POST" style="margin-bottom: 30px; background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
                <h4 style="margin-top: 0; margin-bottom: 15px;">Залишити свій відгук:</h4>

                <label style="display: block; margin-bottom: 15px; font-weight: bold;">
                    Оцінка товару:
                    <select name="rating" style="padding: 8px; border-radius: 4px; margin-left: 10px; border: 1px solid #ccc;">
                        <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                        <option value="4">⭐⭐⭐⭐ (4/5)</option>
                        <option value="3">⭐⭐⭐ (3/5)</option>
                        <option value="2">⭐⭐ (2/5)</option>
                        <option value="1">⭐ (1/5)</option>
                    </select>
                </label>

                <textarea name="comment" required placeholder="Напишіть ваші враження про товар..." style="width: 100%; height: 100px; padding: 10px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 15px; box-sizing: border-box; font-family: inherit; resize: vertical;"></textarea>

                <button type="submit" class="btn btn-green" style="border: none; cursor: pointer; padding: 10px 20px;">Відправити відгук</button>
            </form>
        <?php else: ?>
            <p style="background: #fff3cd; padding: 15px; border-radius: 5px; color: #856404; border: 1px solid #ffeeba;">
                Щоб залишити відгук, будь ласка, <a href="/auth/login" style="color: #0056b3; font-weight: bold;">увійдіть в акаунт</a> або <a href="/auth/register" style="color: #0056b3; font-weight: bold;">зареєструйтеся</a>.
            </p>
        <?php endif; ?>

        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $review): ?>
                <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <strong style="font-size: 1.1em;">👤 <?= htmlspecialchars($review['UserName']) ?></strong>
                        <span style="color: #999; font-size: 0.85em;"><?= date('d.m.Y H:i', strtotime($review['CreatedAt'])) ?></span>
                    </div>

                    <div style="color: #ffc107; margin-bottom: 10px; font-size: 1.1em;">
                        <?= str_repeat('⭐', $review['Rating']) ?><span style="color: #e0e0e0;"><?= str_repeat('★', 5 - $review['Rating']) ?></span>
                    </div>

                    <p style="margin: 0; color: #444; line-height: 1.5;"><?= nl2br(htmlspecialchars($review['Comment'])) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color: #666; font-style: italic;">Поки що немає відгуків. Станьте першим, хто оцінить цей товар!</p>
        <?php endif; ?>
    </div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>