<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {

    public function register() {
        $title = "Реєстрація";
        require_once __DIR__ . '/../Views/register.php';
    }

    public function processRegister() {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (User::findByEmail($email)) {
            $error = "Користувач з таким Email вже існує!";
            $title = "Реєстрація";
            require_once __DIR__ . '/../Views/register.php';
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if (User::create($name, $email, $passwordHash)) {
            header("Location: /auth/login");
            exit();
        }
    }

    public function login() {
        $title = "Вхід";
        require_once __DIR__ . '/../Views/login.php';
    }

    public function processLogin() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['PasswordHash'])) {
            // ЗАЛІЗОБЕТОННЕ РІШЕННЯ: очищуємо дані від невидимих пробілів SQL Server
            $_SESSION['user_id'] = $user['Id'];
            $_SESSION['user_name'] = trim($user['Name']);
            $_SESSION['user_role'] = trim($user['Role']);

            header("Location: /");
            exit();
        } else {
            $error = "Невірний Email або пароль!";
            $title = "Вхід";
            require_once __DIR__ . '/../Views/login.php';
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        header("Location: /");
        exit();
    }
}