<?php
declare(strict_types=1);

$pdo = DatabaseService::getConnection();

$pdo->exec("
CREATE TABLE IF NOT EXISTS articles_article_tag (
    article_id VARCHAR(36),
    tag_id INT,
    FOREIGN KEY (article_id) REFERENCES articles(id),
    FOREIGN KEY (tag_id) REFERENCES article_tags(id)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;
");

echo "Article tags table created.\n";
