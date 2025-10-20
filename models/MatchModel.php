<?php

class MatchModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllMatches() {
        $sql = "SELECT * FROM matches";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllActiveMatches() {
        $sql = "SELECT * FROM matches WHERE datetime_finished IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    
    public function getMatchById($id) {
        $sql = "SELECT id FROM matches WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMatch($name, $location, $datetimeScheduled, $manager_id, $max_players, $image = null){
        $datetimeNow = date('Y-m-d H:i:s');

        $sql = "INSERT INTO matches (name, location, datetime_created, datetime_scheduled, manager_id, max_players, image) VALUES (:name, :location, :datetime_created, :datetime_scheduled, :manager_id, :max_players, :image)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':datetime_created', $datetimeNow);
        $stmt->bindParam(':datetime_scheduled', $datetimeScheduled);
        $stmt->bindParam(':manager_id', $manager_id);
        $stmt->bindParam(':max_players', $max_players);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    
}
?>