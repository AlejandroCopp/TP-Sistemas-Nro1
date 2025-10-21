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

    public function getAllTeamNamesById($id){
        $sql = "SELECT team_name1, team_name2 FROM matches WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $match = $stmt->fetch(PDO::FETCH_NUM);
        return $match;
    }
    
    public function getMatchById($id) {
        $sql = "SELECT * FROM matches WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $match = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($match) {
            if (!empty($match['image'])) {
                $match['image_url'] = 'data:image/png;base64,' . base64_encode($match['image']);
            } else {
                $match['image_url'] = '/public/CanchaImage.png';
            }
        }
    
        return $match;
    }

    public function createMatch($team_name1, $team_name2, $location, $datetimeScheduled, $manager_id, $max_players, $image = null){
        $datetimeNow = date('Y-m-d H:i:s');

        //var_dump($manager_id);

        $sql = "INSERT INTO matches (team_name1, team_name2, location, datetime_created, datetime_scheduled, manager_id, max_players, image) VALUES (:team_name1, :team_name2, :location, :datetime_created, :datetime_scheduled, :manager_id, :max_players, :image)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':team_name1', $team_name1);
        $stmt->bindParam(':team_name2', $team_name2);
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