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

    public function acceptRequestPlayer($matchId, $playerId) {
        $userId = $_SESSION['id'];

        
    }

}