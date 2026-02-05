<?php
// app/routes.php
declare(strict_types=1);

use Slim\App;

require __DIR__ . '/../services/user/user.index.php';

return function(App $app) {
    $userService = new UserService();

    $userRoutes = require __DIR__ . '/../services/user/user.routes.php';
    $userRoutes($app, $userService);
};
