<?php

require_once 'models/UserModel.php';
require_once 'db/Database.php';

# hay correcciones, chequear los comentarios que empiezan por los simbolos #!

class AuthController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
    }

    public function checkRole(){
        return 0;
    }

    public function LoginPage(){
        session_start();
        if(isset($_SESSION["user_id"])){
            header("location:/");
        }else{
            require_once 'views/Login.php';
            Layout(Login());
        }
    }

    public function RegisterPage(){
        session_start();
        if(isset($_SESSION["user_id"])){
            header("location:/");
        }else{
            require_once 'views/register.php';
            Layout(register());
        }

    }

    public function register() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        #! falta hashear la password

        if ($this->userModel->getUserByEmail($email)) {
            http_response_code(409);
            echo json_encode(["message" => "El usuario con este correo electrónico ya existe."]);
            return;
        }

        if ($this->userModel->createUser($name, $email, $password, 'jugador')) {

            session_start();

            header("location:/login");
            // http_response_code(201);
            // echo json_encode(["message" => "Usuario registrado con éxito."]);
            # mostrar cartelito que se ha creado la cuenta con exito
            # redirigir al usuario al login
            
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Error al registrar el usuario."]);
            header("location:/register");
        }
    }

    public function login() { // TODO: Test pending
        $email = $_POST['email'];
        $password = $_POST['password'];

        #! falta sanitizar datos ingresados por el usuario

        $user = $this->userModel->getUserByEmail($email, "id, name, role, password_hash");

        if ($user && password_verify($password, $user['password_hash'])) { 
            
            session_start();

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_role"] = $user["role"];
            # lo reenvio al, el home tiene que validar que la sesion esté iniciada
            header("location:/");
            //$token = $this->generateToken($user['id']);

            //# Responde como API
            // http_response_code(200);
            // echo json_encode(["token" => $token, "user_id" => $user['id']]);
        } else {
            http_response_code(401);
            echo json_encode(["message" => "Credenciales inválidas."]);
        }
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location:/");
    }
    
}