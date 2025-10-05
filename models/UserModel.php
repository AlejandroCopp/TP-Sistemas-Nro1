<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        $sql = "SELECT id, name, email, role FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    
    public function getUserById($id) {
        $sql = "SELECT id, name, email, role FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    # trae los datos de los usuarios segun su email
    public function getUserByEmail($email, $data="id, name, email, password_hash, role") {
        $sql = "SELECT $data FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($name, $email, $password, $role = 'jugador') {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, :role)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $password_hash);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function updateUser($id, $data) {
        if (empty($data)) {
            return false;
        }

        if (isset($data['password'])) {
            if (!empty($data['password'])) {
                $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            unset($data['password']);
        }

        $sql = "UPDATE users SET ";
        $params = [];
        foreach ($data as $key => $value) {
            $sql .= "`$key` = ?, ";
            $params[] = $value;
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function deleteUsers($ids) {
        if (empty($ids)) {
            return false;
        }

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "DELETE FROM users WHERE id IN ($placeholders)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($ids);
    }
}
?>