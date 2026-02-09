<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController {
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function getAll(Request $request, Response $response): Response {
        $response->getBody()->write(json_encode($this->userService->getAll()));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getAllByPage(Request $request, Response $response): Response {
        $response->getBody()->write(json_encode($this->userService->getAllByPage((int)$args['page'])));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getOne(Request $request, Response $response, array $args): Response {
        $user = $this->userService->getById((int)$args['id']);
        $response->getBody()->write(json_encode($user ?? ['error' => 'User not found']));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
