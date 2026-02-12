<?php
declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/database.service.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$pdo = DatabaseService::getConnection();

$pdo->exec("
    CREATE TABLE IF NOT EXISTS migrations_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255) NOT NULL,
        applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");

$migrationDir = __DIR__ . '/migrations/';
$migrations = glob($migrationDir . '*.php');

// $applied = $pdo
//     ->query("SELECT migration FROM migrations_logs")
//     ->fetchAll(PDO::FETCH_COLUMN);

foreach ($migrations as $file) {
    $name = basename($file);
    // if (!in_array($name, $applied)) {
        echo "Applying $name...\n";
        require $file;
        $stmt = $pdo->prepare("INSERT INTO migrations_logs (migration) VALUES (?)");
        $stmt->execute([$name]);
    // }
}

echo "All migrations applied.\n";
