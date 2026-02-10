<?php
declare(strict_types=1);

$pdo = DatabaseService::getConnection();

$pdo->exec("
CREATE TABLE IF NOT EXISTS article_tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(50),
    color VARCHAR(7)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;
");

echo "Article tags table created.\n";
