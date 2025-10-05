<?php

require_once 'models/UserModel.php';
require_once 'db/Database.php';
require_once 'lib/Logger.php';

class AdminController {
    private $userModel;
    private $logger;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
        $this->logger = Logger::getInstance();
    }

    public function AdminPage(){
        $users = $this->userModel->getAllUsers();
    
        $headers = [];
        if (isset($users[0])) {
            $headers = array_keys($users[0]);
        }

        require_once 'views/GestionarUsuarios.php';
        Layout(GestionarUsuarios($headers, $users));
    }

    public function getAllUsers() {
        header('Content-Type: application/json');
        $this->logger->info('Request: GET /api/admin/users');
        
        $response = ["users" => $this->userModel->getAllUsers()];
        
        $this->logger->info('Response: 200 OK', ['body' => $response]);
        echo json_encode($response);
    }

    public function updateUser($id) {
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents('php://input'), true);
        $this->logger->info("Request: PUT /api/admin/user/$id", ['body' => $requestData]);
        
        if (empty($requestData)) {
            http_response_code(400);
            $response = ['error' => 'No data provided for update.'];
            $this->logger->error('Response: 400 Bad Request', ['body' => $response]);
            echo json_encode($response);
            return;
        }

        if ($this->userModel->updateUser($id, $requestData)) {
            $updatedUser = $this->userModel->getUserById($id);
            $this->logger->info('Response: 200 OK', ['body' => $updatedUser]);
            echo json_encode($updatedUser);
        } else {
            http_response_code(500);
            $response = ['error' => 'Failed to update user.'];
            $this->logger->error('Response: 500 Internal Server Error', ['body' => $response]);
            echo json_encode($response);
        }
    }

    public function deleteUser($id) {
        header('Content-Type: application/json');
        $this->logger->info("Request: DELETE /api/admin/user/$id");

        if ($this->userModel->deleteUsers([$id])) {
            $response = ['success' => true, 'message' => 'User deleted successfully.'];
            $this->logger->info('Response: 200 OK', ['body' => $response]);
            echo json_encode($response);
        } else {
            http_response_code(500);
            $response = ['error' => 'Failed to delete user.'];
            $this->logger->error('Response: 500 Internal Server Error', ['body' => $response]);
            echo json_encode($response);
        }
    }

    public function deleteUsers() {
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents('php://input'), true);
        $this->logger->info("Request: DELETE /api/admin/users", ['body' => $requestData]);
        
        $ids = $requestData['ids'] ?? [];

        if (empty($ids)) {
            http_response_code(400);
            $response = ['error' => 'No user IDs provided for deletion.'];
            $this->logger->error('Response: 400 Bad Request', ['body' => $response]);
            echo json_encode($response);
            return;
        }

        if ($this->userModel->deleteUsers($ids)) {
            $response = ['success' => true, 'message' => 'Users deleted successfully.'];
            $this->logger->info('Response: 200 OK', ['body' => $response]);
            echo json_encode($response);
        } else {
            http_response_code(500);
            $response = ['error' => 'Failed to delete users.'];
            $this->logger->error('Response: 500 Internal Server Error', ['body' => $response]);
            echo json_encode($response);
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