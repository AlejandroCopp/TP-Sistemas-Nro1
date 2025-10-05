<?php

require_once 'models/UserModel.php';
require_once 'db/Database.php';
require_once 'lib/Logger.php';

class AuthController {
    private $userModel;
    private $logger;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
        $this->logger = Logger::getInstance();
    }

    public function LoginPage(){
        // This method renders a page, so it doesn't return JSON.
        // Session logic is still needed for page access control.
        @session_start();
        if(isset($_SESSION["user_id"])){
            header("location:/");
        }else{
            require_once 'views/Login.php';
            Layout(Login());
        }
    }

    public function RegisterPage(){
        // This method renders a page, so it doesn't return JSON.
        @session_start();
        if(isset($_SESSION["user_id"])){
            header("location:/");
        }else{
            require_once 'views/register.php';
            Layout(register());
        }
    }

    public function register() {
        header('Content-Type: application/json');
        $this->logger->info('Request: POST /api/auth/register', ['body' => $_POST]);

        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (empty($name) || empty($email) || empty($password)) {
            http_response_code(400);
            $response = ["message" => "Name, email, and password are required."];
            $this->logger->error('Response: 400 Bad Request', ['body' => $response]);
            echo json_encode($response);
            return;
        }

        if ($this->userModel->getUserByEmail($email)) {
            http_response_code(409);
            $response = ["message" => "El usuario con este correo electrónico ya existe."];
            $this->logger->error('Response: 409 Conflict', ['body' => $response]);
            echo json_encode($response);
            return;
        }

        if ($this->userModel->createUser($name, $email, $password, 'jugador')) {
            session_start();
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $role; 
            
            http_response_code(201);
            $response = ["message" => "Usuario registrado con éxito."];
            $this->logger->info('Response: 201 Created', ['body' => $response]);
            echo json_encode($response);
        } else {
            http_response_code(500);
            $response = ["message" => "Error al registrar el usuario."];
            $this->logger->error('Response: 500 Internal Server Error', ['body' => $response]);
            echo json_encode($response);
        }
    }
    
    public function login() {
        header('Content-Type: application/json');
        $this->logger->info('Request: POST /api/auth/login', ['body' => $_POST]);
        
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        
        $user = $this->userModel->getUserByEmail($email, "id, name, role, password_hash");
        
        if ($user && password_verify($password, $user['password_hash'])) {
            // Note: In a stateless API, you would generate and return a token (e.g., JWT) here.
            // For now, we return user data and a success message.
            session_start();
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $role;

            $this->logger->info('Response: 200 OK', ['body' => $response]);
            
            header("Location:/");
        } else {
            http_response_code(401);
            $response = ["message" => "Credenciales inválidas."];
            $this->logger->error('Response: 401 Unauthorized', ['body' => $response, 'email' => $email]);
            echo json_encode($response);
        }
    }

    public function logout(){
        header('Content-Type: application/json');
        $this->logger->info('Request: POST /api/auth/logout');
        

        session_start();
        session_unset();
        session_destroy();
        // In a stateless API, the client is responsible for destroying the token.
        // The server just confirms the logout action.
        http_response_code(200);
        $response = ["message" => "Logout successful."];
        $this->logger->info('Response: 200 OK', ['body' => $response]);
        echo json_encode($response);
    }
}