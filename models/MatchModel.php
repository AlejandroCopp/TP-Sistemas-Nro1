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
        $sql = "
            SELECT 
                m.id,
                m.name,
                m.location,
                m.datetime_scheduled,
                m.max_players,
                m.image,
                (SELECT COUNT(*) FROM match_players mp WHERE mp.match_id = m.id AND mp.datetime_player_added IS NOT NULL) AS actualPlayers,
                CASE
                    WHEN m.datetime_started IS NOT NULL AND m.datetime_finished IS NULL THEN 'Jugando'
                    WHEN m.datetime_finished IS NOT NULL THEN 'Finalizado'
                    ELSE 'Programado'
                END AS status
            FROM 
                matches m
            WHERE
                m.id = :id;
        ";
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