<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Order {
    public static function getAllWithUsers() {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->query("
            SELECT Orders.*, Users.Name as UserName 
            FROM Orders 
            LEFT JOIN Users ON Orders.UserId = Users.Id 
            ORDER BY Orders.CreatedAt DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}