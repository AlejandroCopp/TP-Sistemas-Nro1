<?php

require_once 'models/UserModel.php';
require_once 'db/Database.php';

class AdminController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
    }

    public function AdminPage(){
        require_once __DIR__ . '/views/GestionarUsuarios.php';
        Layout(GestionarUsuarios());
    }

    public function getAllUsers() {
        echo json_encode(["users" => $this->userModel->getAllUsers()]);
    }

    public function resetUserPassword() {
        $userId = $_POST['userId'];
        $new_password = $this->genPassword();

        if ($this->userModel->changeUserPassword($userId, $new_password)) {
            echo json_encode(["new_passwd" => $new_password]);
        } else {
            http_response_code(500);
            echo json_encode([]);
        }
    }

    // public function actualizarUsuario(){
    //     $ = $_POST[""];
    //     $ = $_POST[""];
    //     $ = $_POST[""];
    //     $ = $_POST[""];
    //     $ = $_POST[""];

    // valida que los datos existan
    // el user model deberia tener un metodo llamado cambiar campo donde reciba un objeto y utilice el nombre de las 
    // propiedades para identificar el campo y luego el valor para identificar que valor se quiere cambiar, 
    // luego armar una sentencia sql con los campos que se cambiaron e impactar los datos en la base de datos
    // }

    public function changeUserName() {
        $userId = $_POST['userId'];
        $userName = $_POST['userName'];

        if ($this->userModel->changeUserName($userId, $userName)) {
            echo json_encode(["userName" => $userName]);
        } else {
            http_response_code(500);
            echo json_encode([]);
        }
    }

    public function changeUserEmail() {
        $userId = $_POST['userId'];
        $userEmail = $_POST['email'];

        if ($this->userModel->changeUserEmail($userId, $userEmail)) {
            echo json_encode(["userEmail" => $userEmail]);
        } else {
            http_response_code(500);
            echo json_encode([]);
        }
    }

    public function changeUserRole() {
        $userId = $_POST['userId'];
        $userRole = $_POST['userRole'];

        if ($this->userModel->changeUserRole($userId, $userRole)) {
            echo json_encode(["userRole" => $userRole]);
        } else {
            http_response_code(500);
            echo json_encode([]);
        }
    }
    
    function genPassword($len = 14) {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+';
        $password = '';
        for ($i = 0; $i < $len; $i++) {
            $password .= $charset[random_int(0, strlen($charset) - 1)];
        }
    return $password;
    }
    
}