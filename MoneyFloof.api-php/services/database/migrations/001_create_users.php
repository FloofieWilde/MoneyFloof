<?php
declare(strict_types=1);

$pdo = DatabaseService::getConnection();

$pdo->exec("
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;
");

echo "Users table created.\n";
