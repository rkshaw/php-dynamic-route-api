<?php
namespace App\Services;
use PDO;
use PDOException;

class Database {
    private static ?PDO $conn = null;
    public static function getConnection(): PDO {
        if (self::$conn === null) {
            $cfg = include __DIR__ . '/../Config/config.php';
            try {
                self::$conn = new PDO($cfg['db']['dsn'], $cfg['db']['user'], $cfg['db']['pass']);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new \Exception('DB Connection failed: ' . $e->getMessage(), 500);
            }
        }
        return self::$conn;
    }
}
