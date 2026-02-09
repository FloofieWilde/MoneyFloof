<?php
// services/user/user.routes.php

use Slim\App;

return function(App $app, UserService $userService) {
    $controller = new UserController($userService);

    $app->get('/api/users', [$controller, 'getAll']);
    $app->get('/api/users/{page}', [$controller, 'getAllByPage']);
    $app->get('/api/user/{id}', [$controller, 'getOne']);
};
