<?php
declare(strict_types=1);

$pdo = DatabaseService::getConnection();

$pdo->exec("
CREATE TABLE IF NOT EXISTS articles (
    id VARCHAR(36) PRIMARY KEY
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;
");

echo "Articles table created.\n";
