<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Review {
    public static function getByProductId($productId) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT r.*, u.Name as UserName
            FROM Reviews r
            JOIN Users u ON r.UserId = u.Id
            WHERE r.ProductId = ?
            ORDER BY r.CreatedAt DESC
        ");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function add($productId, $userId, $rating, $comment) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO Reviews (ProductId, UserId, Rating, Comment, CreatedAt) VALUES (?, ?, ?, ?, GETDATE())");
        return $stmt->execute([$productId, $userId, $rating, $comment]);
    }
}