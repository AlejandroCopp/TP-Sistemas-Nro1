<?php

require_once 'models/UserModel.php';
require_once 'models/MatchModel.php';
require_once 'models/MatchPlayerModel.php';

require_once 'db/Database.php';
require_once 'lib/Logger.php';

class MatchesController {
    private $userModel;
    private $matchModel;
    private $matchPlayerModel;
    private $logger;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database->getConnection());
        $this->matchModel = new MatchModel($database->getConnection());
        $this->matchPlayerModel = new MatchPlayerModel($database->getConnection());
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

    public function showMatchPage($match_id) {
        $match = $this->matchModel->getMatchById($match_id);

        if (!$match) {
            http_response_code(404);
            // A simple error page could be rendered here
            echo "<h1>404 - Partido no encontrado</h1>";
            return;
        }

        // Fetch player IDs for the match
        $player_id_rows = $this->matchPlayerModel->getAllActivePlayersByMatchId($match_id);
        
        // Fetch full details for each player
        $players = [];
        foreach ($player_id_rows as $row) {
            $player_info = $this->userModel->getUserById($row['player_id']);
            if ($player_info) {
                $players[] = $player_info;
            }
        }

        // Divide players into two teams
        $team_size = $match['max_players'] / 2;
        $team_a = array_slice($players, 0, $team_size);
        $team_b = array_slice($players, $team_size, $team_size);

        $data = [
            'match' => $match,
            'team_a' => $team_a,
            'team_b' => $team_b,
        ];

        // Render the view, passing the data to it
        require_once 'views/Match.php';
        // The Layout function will wrap the page content with the header and footer
        Layout(MatchPage($data));
    }

}
