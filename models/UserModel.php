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

    public function getUserByEmail($email) {
        $sql = "SELECT id, name, email, role FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //public function getUserByEmail($email) {
    //    $sql = "SELECT id, role, password_hash FROM users WHERE id = :id";
    //    $stmt = $this->db->prepare($sql);
    //    $stmt->bindParam(':id', $id);
    //    $stmt->execute();
    //    return $stmt->fetch(PDO::FETCH_ASSOC)[0];
    //}

    public function createUser($name, $email, $password, $role = 'jugador') {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, :role)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $password_hash);
        $stmt->bindParam(':role', $role);
        //$stmt->bindParam(':position', $position);
        
        return $stmt->execute();
    }

    public function changeUserPassword($id, $new_password) {
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password_hash = ? WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':password_hash', $password_hash);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function changeUserName($id, $new_name) {
        $sql = "UPDATE users SET name = :name WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $new_name);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function changeUserEmail($id, $new_email) {
        $sql = "UPDATE users SET email = :email WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $new_email);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function changeUserRole($id, $new_role) {
        $sql = "UPDATE users SET role = :role WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':role', $new_role);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>