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

    public function getAllActivePlayersByMatchId($matchId) {
        $sql = "SELECT player_id FROM match_players WHERE match_id = :match_id AND datetime_player_added IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':match_id', $matchId);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    
    public function getPendingPlayersByMatchId($matchId) {
        $sql = "SELECT player_id FROM match_players WHERE match_id = :match_id AND datetime_player_added IS NULL AND datetime_player_declined IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':match_id', $matchId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function acceptPlayer($matchId, $playerId) {
        $sql = "UPDATE match_players SET datetime_player_added = NOW(), datetime_player_declined = NULL WHERE match_id = :match_id AND player_id = :player_id";
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
    
}
?>