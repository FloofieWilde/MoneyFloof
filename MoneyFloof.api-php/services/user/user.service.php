<?php
// services/user/user.service.php
declare(strict_types=1);

class UserService {
    private PDO $db;
    private string $tableName = "users";

    public function __construct(DatabaseService $dbService) {
        $this->db = $dbService->getConnection();
    }

    public function getAll(): array {
        $sql = "
            SELECT
                id,
                username,
                lastname,
                firstname,
                created_at,
                last_login,
                last_activity
            FROM {$this->tableName}
        ";

        return DatabaseService::query($sql);
    }

    // TODO : Fix
    public function getAllByPage(int $page) {
        return DatabaseService::getAllByPage($this->tableName, $page);
    }

    public function getById(int $id): ?array {
        $sql = "
            SELECT
                id,
                username,
                lastname,
                firstname,
                created_at,
                last_login,
                last_activity
            FROM {$this->tableName}
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch() ?: null;
        return $user;
    }
}
