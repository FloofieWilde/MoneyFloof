<?php
// services/user/user.service.php
declare(strict_types=1);

class UserService {
    private PDO $db;

    public function __construct(DatabaseService $dbService) {
        $this->db = $dbService->getConnection();
    }

    public function getAll(): array {
        // Mock data
        return [
            ['id' => 1, 'username' => 'CanisGenesis'],
            ['id' => 2, 'username' => 'Floofie'],
        ];
    }

    public function getById(int $id): ?array {
        foreach ($this->getAll() as $user) {
            if ($user['id'] === $id) return $user;
        }
        return null;
    }
}
