<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Product {

    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM Products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM Products WHERE Id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getTopSelling($limit = 5) {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("
            SELECT TOP {$limit} p.*, ISNULL(t.TotalSold, 0) as TotalSold
            FROM Products p
            LEFT JOIN (
                SELECT ProductId, SUM(Quantity) as TotalSold
                FROM OrderItems
                GROUP BY ProductId
            ) t ON p.Id = t.ProductId
            ORDER BY TotalSold DESC, p.Id ASC
        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}