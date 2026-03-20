<?php require_once __DIR__ . '/partials/header.php'; ?>

    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 400px; margin: 40px auto;">
        <h2 style="text-align: center;">Реєстрація</h2>

        <?php if (isset($error)): ?>
            <p style="color: red; text-align: center; font-weight: bold;"><?= $error ?></p>
        <?php endif; ?>

        <form action="/auth/processRegister" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <input type="text" name="name" placeholder="Ваше ім'я" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            <input type="email" name="email" placeholder="Email" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            <input type="password" name="password" placeholder="Пароль" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" class="btn btn-blue" style="font-size: 1.1em; padding: 10px; border: none; cursor: pointer;">Зареєструватися</button>
        </form>
        <p style="text-align: center; margin-top: 15px;">Вже є акаунт? <a href="/auth/login" style="color: #0066cc;">Увійти</a></p>
    </div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>