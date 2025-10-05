<?php

require_once 'models/UserModel.php';
require_once 'db/Database.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
    }

    public function register() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = 'jugador'; // default role

        if ($this->userModel->getUserByEmail($email)) {
            return false;
        }

        if ($this->userModel->createUser($name, $email, $password, $role)) {
            session_start();

            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $role;

            return true;
        }

        return false;
    }

    public function login() { // TODO: Test pending
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            $token = $this->generateToken($user['id']);
            http_response_code(200);
            echo json_encode(["token" => $token, "user_id" => $user['id']]);

            session_start();

            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $role;

            return true;
        }

        return false;
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }
    
}