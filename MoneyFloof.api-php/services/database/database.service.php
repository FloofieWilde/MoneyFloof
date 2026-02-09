<?php
declare(strict_types=1);

class DatabaseService {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $dsn = sprintf(
                '%s:host=%s;port=%s;dbname=%s;charset=%s',
                $_ENV['DB_DRIVER'],
                $_ENV['DB_HOST'],
                $_ENV['DB_PORT'],
                $_ENV['DB_NAME'],
                $_ENV['DB_CHARSET']
            );

            self::$instance = new PDO(
                $dsn,
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }

        return self::$instance;
    }

    // ------------ //
    //  DB Helpers  //
    // ------------ //

    #region DB Columns Getters
    // Check if one column exists
    public static function columnExists(string $table, string $column): bool {
        $stmt = self::getConnection()->prepare("
            SELECT COUNT(*) 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?
        ");
        $stmt->execute([$table, $column]);
        return (bool)$stmt->fetchColumn();
    }

    // Get all column names in a table
    public static function getColumns(string $table): array {
        $stmt = self::getConnection()->prepare("
            SELECT COLUMN_NAME 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?
        ");
        $stmt->execute([$table]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    // Check if a table exists
    public static function tableExists(string $table): bool {
        $stmt = self::getConnection()->prepare("
            SELECT COUNT(*) 
            FROM INFORMATION_SCHEMA.TABLES 
            WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?
        ");
        $stmt->execute([$table]);
        return (bool)$stmt->fetchColumn();
    }
    #endregion

    #region DB Modifiers
    // Check if a column doesn't exist ad add it if it doesn't
    public static function addColumn(string $table, string $column, string $definition): void {
        if (!self::columnExists($table, $column)) {
            $sql = sprintf("ALTER TABLE %s ADD COLUMN %s %s", $table, $column, $definition);
            self::getConnection()->exec($sql);
            echo "Added column: $column in $table\n";
        }
    }

    public static function addColumns(string $table, array $columns): void {
        // Récupérer une seule fois les colonnes existantes
        $existingColumns = self::getColumns($table);

        foreach ($columns as $name => $definition) {
            if (!in_array($name, $existingColumns)) {
                $sql = sprintf("ALTER TABLE %s ADD COLUMN %s %s", $table, $name, $definition);
                self::getConnection()->exec($sql);
                echo "Added column: $name in $table\n";
            }
        }
    }
    #endregion

    #region DB Query
    public static function query(string $sql, array $params = []): array {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function execute(string $sql, array $params = []): bool {
        $stmt = self::getConnection()->prepare($sql);
        return $stmt->execute($params);
    }

    public static function getLastInsertId(): string {
        return self::getConnection()->lastInsertId();
    }
    #endregion
}
