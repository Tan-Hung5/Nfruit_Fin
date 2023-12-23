<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserHandler {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(Request $request, Response $response): Response {
        $users = $this->userRepository->getAllUsers();
        return $response->withJson($users);
    }

    public function getUser(Request $request, Response $response, array $args): Response {
        $userId = $args['id'];
        $user = $this->userRepository->getUserById($userId);

        if ($user) {
            return $response->withJson($user);
        } else {
            return $response->withJson(['error' => 'User not found'], 404);
        }
    }

    public function getIdUser(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $userEmail = $data['email'];
        $id = $this->userRepository->getIdUserByEmail($userEmail);

        if($id) {
            return $response->withJson($id);
        } else {
            return $response->withJson(400);
        }
    }

    public function auth(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $userId = $data['id'];
        $user = $this->userRepository->auth($userId);

        if ($user) {
            return $response->withJson($user);
        } else {
            return $response->withJson(['error' => 'User not found'], 404);
        }
    }

    public function createUser(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $user = new User(null,$data['username'],$data['email'],$data['phone'],$data['password'],null);
        if (!empty($data['username']) && !empty($data['email']) && !empty($data['phone']) && !empty($data['password'])) {
            $this->userRepository->createUser($user);
            return $response->withJson(['message' => 'User created successfully']);
        } else {
            return $response->withJson(['error' => 'Invalid data'], 400);
        }
    }

    public function updateUser(Request $request, Response $response, array $args): Response {
        $userId = $args['id'];
        $data = $request->getParsedBody();
        $username = $data['username'] ?? '';
        $email = $data['email'] ?? '';

        if (!empty($username) && !empty($email)) {
            $this->userRepository->updateUser($userId, $username, $email);
            return $response->withJson(['message' => 'User updated successfully']);
        } else {
            return $response->withJson(['error' => 'Invalid data'], 400);
        }
    }

    public function deleteUser(Request $request, Response $response, array $args): Response {
        $userId = $args['id'];
        $this->userRepository->deleteUser($userId);
        return $response->withJson(['message' => 'User deleted successfully']);
    }
}
