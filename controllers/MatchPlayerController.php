<?php

require_once 'models/UserModel.php';
require_once 'models/MatchModel.php';
require_once 'models/MatchPlayerModel.php';

require_once 'db/Database.php';
require_once 'lib/Logger.php';

class MatchPlayerController {
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

    public function acceptRequestPlayer() {
        $matchId = $_POST['matchId'];
        $playerId = $_POST['playerId'];

        $match = $this->matchModel->getMatchById($matchId);
        if ($match['manager_id'] === $_SESSION['id']){

            $this->MatchPlayerModel->acceptPlayer($matchId, $playerId); // todo: si ya fue aceptado devolver un error (workaround actual mediante sql)

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'ok!']);
        }
    }

    public function declineRequestPlayer() {
        $matchId = $_POST['matchId'];
        $playerId = $_POST['playerId'];

        $match = $this->matchModel->getMatchById($matchId);
        if ($match['manager_id'] === $_SESSION['id']){

            $this->MatchPlayerModel->declinePlayer($matchId, $playerId);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'ok!']);
        }
    }


    public function userMatchRequest(){
        $matchId = $_POST['matchId'];
        $position = $_POST['position'];
        $userId = $_SESSION['id'];

        if (!$this->MatchPlayerModel->userAlreadyRequested($matchId, $userId)) {
            $this->MatchPlayerModel->requestUserMatch($matchId, $position, $userId);
            echo json_encode(['success' => true, 'message' => 'Solicitud enviada']);
            return;

        }

        echo json_encode(['success' => false, 'message' => 'Ya existe una solicitud para este partido']);
    }
}