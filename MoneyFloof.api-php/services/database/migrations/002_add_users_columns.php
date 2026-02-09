<?php
if (DatabaseService::tableExists('users')) {
    $columns = [
        'username'      => 'VARCHAR(50) NOT NULL UNIQUE',
        'password'      => 'CHAR(32) NOT NULL',
        'lastname'      => 'VARCHAR(50) NOT NULL',
        'firstname'     => 'VARCHAR(50) NOT NULL',
        'created_at'    => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'last_login'    => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'last_activity' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
    ];

    DatabaseService::addColumns('users', $columns);
}