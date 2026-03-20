<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 600px; margin: auto;">
        <h1>📦 Оформлення замовлення</h1>
        <p>Будь ласка, введіть свої дані для доставки.</p>

        <form action="/checkout/process" method="POST" style="display: flex; flex-direction: column; gap: 15px;">

            <div>
                <label style="font-weight: bold;">Ваше ім'я:</label><br>
                <input type="text" name="name" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div>
                <label style="font-weight: bold;">Телефон:</label><br>
                <input type="tel" name="phone" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div>
                <label style="font-weight: bold;">Адреса доставки:</label><br>
                <textarea name="address" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; height: 80px; box-sizing: border-box;"></textarea>
            </div>

            <button type="submit" class="btn btn-green" style="font-size: 1.2em; padding: 15px; border: none; cursor: pointer;">✅ Підтвердити замовлення</button>
        </form>
    </div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>