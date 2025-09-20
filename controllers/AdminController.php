<?php

require_once 'models/UserModel.php';
require_once 'db/Database.php';

class AdminController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
    }

    public function getAllUsers() {
        echo json_encode(["users" => $this->userModel->getAllUsers()]);
    }

    public function resetUserPassword() {
        $userId = $_POST['userId'];
        $new_password = $this->genPassowrd();

        if ($this->userModel->changeUserPassword($userId, $new_password)) {
            echo json_encode(["new_passwd" => $new_password]);
        } else {
            http_response_code(500);
            echo json_encode([]);
        }
    }

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
    
    function genPassowrd($len = 14) {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+';
        $password = '';
        for ($i = 0; $i < $len; $i++) {
            $password .= $charset[random_int(0, strlen($charset) - 1)];
        }
    return $password;
}

    
}