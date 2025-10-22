<?php

require_once 'models/UserModel.php';
require_once 'models/MatchModel.php';
require_once 'models/MatchPlayerModel.php';
require_once 'views/Match.php';

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
                'matchType' => $match['team_name1'] . ' vs ' . $match['team_name2'], 
                'location' => $match['location'],
                'scheduled' => $scheduledTimestamp,
                'status' => $status,
                'maxPlayers' => $match['max_players'],
                'actualPlayers' => $actualPlayers
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
        //$name = $_POST['name'];
        $team_name1 = $_POST['team_name1'];
        $team_name2 = $_POST['team_name2'];
        $location = $_POST['location'];
        $id_user = $_SESSION["id"]; //$this->userModel->getUserByEmail($_SESSION["email"]);
        $datetimeScheduled = $_POST['datetimeScheduled'];
        $max_players = $_POST['maxPlayers'];
        //$image = $_POST['image']
        $datetimeScheduledDb = (new DateTime())->setTimestamp($datetimeScheduled)->format('Y-m-d H:i:s');

        $newMatch = $this->matchModel->createMatch($team_name1, $team_name2, $location, $datetimeScheduledDb, $id_user, $max_players);

        //var_dump(json_encode(
        //    $newMatch
        //));
    }

    // public function userMatchRequest(){
    //     $matchId = $_POST['matchId'];
    //     $position = $_POST['position'];
    //     $userId = $_SESSION['id'];

    //     if (!$this->MatchPlayerModel->userAlreadyRequested($matchId, $userId)) {
    //         $this->MatchPlayerModel->requestUserMatch($matchId, $position, $userId);
    //         echo json_encode(['success' => true, 'message' => 'Solicitud enviada']);
    //         return;

    //     }

    //     echo json_encode(['success' => false, 'message' => 'Ya existe una solicitud para este partido']);
    // }

    public function showMatchPage($match_id) {
        $match = $this->matchModel->getMatchById($match_id);

        if (!$match) {
            http_response_code(404);
            // A simple error page could be rendered here
            echo "<h1>404 - Partido no encontrado</h1>";
            return;
        }

        // Fetch player IDs for the match
        $player_id_rows = $this->MatchPlayerModel->getAllActivePlayersByMatchId($match_id);
        
        // Fetch full details for each player
        $players = [];
        foreach ($player_id_rows as $row) {
            $player_info = $this->userModel->getUserById($row['id']);
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
        // The Layout function will wrap the page content with the header and footer
        Layout(MatchPage($data));
    }

    
}
