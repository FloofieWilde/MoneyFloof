<?php
// app/routes.php
declare(strict_types=1);

use Slim\App;

require __DIR__ . '/../services/user/user.index.php';
require __DIR__ . '/../services/database/database.service.php';

return function(App $app) {
    $databaseService = new DatabaseService();
    $userService = new UserService($databaseService);

    $userRoutes = require __DIR__ . '/../services/user/user.routes.php';
    $userRoutes($app, $userService);
};
