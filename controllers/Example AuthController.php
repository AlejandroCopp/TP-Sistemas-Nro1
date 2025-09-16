<?php

require_once 'UserModel.php';
require_once 'Database.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
    }

    public function register($data) {
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $position = isset($data['position']) ? $data['position'] : null;

        if ($this->userModel->getUserByEmail($email)) {
            http_response_code(409);
            echo json_encode(["message" => "El usuario con este correo electrónico ya existe."]);
            return;
        }

        if ($this->userModel->createUser($name, $email, $password, 'jugador', $position)) {
            http_response_code(201);
            echo json_encode(["message" => "Usuario registrado con éxito."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Error al registrar el usuario."]);
        }
    }

    public function login($data) {
        $email = $data['email'];
        $password = $data['password'];

        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            $token = $this->generateToken($user['id']);
            http_response_code(200);
            echo json_encode(["token" => $token, "user_id" => $user['id']]);
        } else {
            http_response_code(401);
            echo json_encode(["message" => "Credenciales inválidas."]);
        }
    }

    private function generateToken($userId) {
        return bin2hex(random_bytes(32)); 
    }
}