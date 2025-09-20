<?php

require_once 'models/UserModel.php';
require_once 'db/Database.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
    }

    public function test(){
        echo json_encode([
            "test" => 1234,
            "a" => "asd"
        ]);

        http_response_code(201);
    }

    public function register() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($this->userModel->getUserByEmail($email)) {
            http_response_code(409);
            echo json_encode(["message" => "El usuario con este correo electrónico ya existe."]);
            return;
        }

        if ($this->userModel->createUser($name, $email, $password, 'jugador')) {
            http_response_code(201);
            echo json_encode(["message" => "Usuario registrado con éxito."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Error al registrar el usuario."]);
        }
    }

    public function login() { // TODO: Test pending
        $email = $_POST['email'];
        $password = $_POST['password'];

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
    
}