<?php
declare(strict_types=1);

$pdo = DatabaseService::getConnection();

$pdo->exec("
CREATE TABLE IF NOT EXISTS status_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) 
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;
");

echo "Status item table created.\n";
