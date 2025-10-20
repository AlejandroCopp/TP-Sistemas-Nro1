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
                'status' => $status
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function createMatch(){
        $name = $_POST['name'];
        $location = $_POST['location'];
        $datetimeScheduled = $_POST['datetimeScheduled'];
        $max_players = $_POST['maxPlayers'];
        //$image = $_POST['image']

        $datetimeScheduledDb = (new DateTime())->setTimestamp($datetimeScheduled)->format('Y-m-d H:i:s');

        $this->matchModel->createMatch($name, $location, $datetimeScheduledDb, $_SESSION["id"], $max_players);

        // $name, $location, $datetimeScheduled, $manager_id, $max_players, $image = null
    }

}
