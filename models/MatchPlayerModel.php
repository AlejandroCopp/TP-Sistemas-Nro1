<?php

class MatchPlayerModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllMatchPlayers() {
        $sql = "SELECT * FROM match_players";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllPlayersByMatchId($matchId) {
        $sql = "SELECT player_id FROM match_players WHERE match_id = :match_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':match_id', $matchId);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function countActivePlayersByMatchId($matchId) {
        $sql = "SELECT COUNT(*) AS total_players FROM match_players WHERE match_id = :match_id AND datetime_player_added IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':match_id', $matchId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_players'];
    }

    public function getAllActivePlayersByMatchId($matchId) {
        $sql = "SELECT u.id, u.name, mp.position FROM match_players mp JOIN users u ON mp.player_id = u.id WHERE mp.match_id = :match_id AND mp.datetime_player_added IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':match_id', $matchId);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    
    public function getPendingPlayersByMatchId($matchId) {
        //$sql = "SELECT player_id FROM match_players WHERE match_id = :match_id AND datetime_player_added IS NULL AND datetime_player_declined IS NULL";
        $sql = "SELECT u.id, u.name, mp.position, mp.team FROM match_players mp JOIN users u ON mp.player_id = u.id WHERE mp.match_id = :match_id AND mp.datetime_player_declined IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':match_id', $matchId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function userAlreadyRequested($matchId, $userId){
        $sql = "SELECT COUNT(*) AS total FROM match_players WHERE match_id = :match_id AND player_id = :player_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':match_id' => $matchId,
            ':player_id' => $userId
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }

    public function acceptPlayer($matchId, $playerId) {
        $sql = "UPDATE match_players SET datetime_player_added = NOW(), datetime_player_declined = NULL WHERE match_id = :match_id AND player_id = :player_id AND datetime_player_declined IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':match_id' => $matchId,
            ':player_id' => $playerId
        ]);
    }
    
    public function declinePlayer($matchId, $playerId) {
        $sql = "UPDATE match_players SET datetime_player_declined = NOW(), datetime_player_added = NULL WHERE match_id = :match_id AND player_id = :player_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':match_id' => $matchId,
            ':player_id' => $playerId
        ]);
    }

    public function requestUserMatch($matchId, $position, $team, $playerId) {
        $sql = "INSERT INTO match_players (match_id, position, team, player_id) VALUES (:match_id, :position, :team :player_id)";
        $stmt = $this->db->prepare($sql);
        
        $stmt->execute([
            ':match_id' => $matchId,
            ':position' => $position,
            ':team' => $team,
            ':player_id' => $playerId
        ]);
    }

}
?>