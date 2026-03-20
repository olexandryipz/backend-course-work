<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User {
    public static function findByEmail($email) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($name, $email, $passwordHash) {
        $db = Database::getInstance()->getConnection();
        $role = 'Customer';
        $createdAt = date('Y-m-d H:i:s');

        $stmt = $db->prepare("INSERT INTO Users (Role, Name, Email, PasswordHash, CreatedAt) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$role, $name, $email, $passwordHash, $createdAt]);
    }
}