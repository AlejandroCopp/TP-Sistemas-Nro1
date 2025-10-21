<?php

require_once 'models/UserModel.php';
require_once 'models/MatchModel.php';
require_once 'models/MatchPlayerModel.php';

require_once 'db/Database.php';
require_once 'lib/Logger.php';

class MatchesController {
    private $userModel;
    private $matchModel;
    private $MatchPlayerModel;
    private $logger;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
        $this->matchModel = new MatchModel($database->getConnection());
        $this->MatchPlayerModel = new MatchPlayerModel($database->getConnection());
    }

    public function getMatches() {
        $matches = $this->matchModel->getAllActiveMatches();
        $response = [];
        
        foreach ($matches as $match) {
            $actualPlayers = $this->MatchPlayerModel->countActivePlayersByMatchId($match['id']);

            $scheduledTimestamp = strtotime($match['datetime_scheduled']);
            $now = time();
            if ($now > $scheduledTimestamp) {
                $status = 'Jugando';
            } elseif ($match['datetime_started'] !== null) {
                $status = 'Activo';
            } else {
                $status = 'Buscando jugadores';
            }

            $response[] = [
                'id' => $match['id'],
                'name' => $match['name'], 
                'location' => $match['location'],
                'scheduled' => strtotime($match['datetime_scheduled']),
                'status' => $status,
                'maxPlayers ' => $match['max_players'],
                'actualPlayers ' => $actualPlayers
            ];
        } // nombre, posicion, equipo

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getPlayers() {
        $matchId = $_POST['matchId'];

        $actualPlayers = $this->MatchPlayerModel->getAllActivePlayersByMatchId($matchId);

        header('Content-Type: application/json');
        echo json_encode($actualPlayers);
    }

    public function getManagerPlayers(){
        $matchId = $_POST['matchId'];

        $match = $this->matchModel->getMatchById($matchId);
        if ($match['manager_id'] === $_SESSION['id']){
            $response = $this->MatchPlayerModel->getPendingPlayersByMatchId($_POST['matchId']);

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function createMatch(){
        $name = $_POST['name'];
        $location = $_POST['location'];
        $datetimeScheduled = $_POST['datetimeScheduled'];
        $max_players = $_POST['maxPlayers'];
        //$image = $_POST['image']

        $datetimeScheduledDb = (new DateTime())->setTimestamp($datetimeScheduled)->format('Y-m-d H:i:s');

        $this->matchModel->createMatch($name, $location, $datetimeScheduledDb, $_SESSION["id"], $max_players);
    }

}
