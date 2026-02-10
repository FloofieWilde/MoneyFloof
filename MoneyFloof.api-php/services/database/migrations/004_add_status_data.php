<?php

$pdo = DatabaseService::getConnection();

$pdo->exec("
    INSERT INTO status_item (id, name)
    VALUES
        (1, 'Income'),
        (2, 'Wishlist'),
        (3, 'Needlist'),
        (4, 'Scheduled'),
        (5, 'PaidPartial'),
        (6, 'Ordered'),
        (7, 'MultiplePaiements'),
        (8, 'DeliveredPaid'),
        (9, 'Canceled')
    ON DUPLICATE KEY UPDATE
        name = VALUES(name);
");