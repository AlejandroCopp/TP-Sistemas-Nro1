<?php
require_once 'models/UserModel.php';
require_once 'db/Database.php';

class AppController{

  private $userModel;

  public function __construct(){
    $database = new Database();
    $this->userModel = new UserModel($database->getConnection());
  }

  public function MainPage(){
    if(isset($_SESSION["name"])){
      require_once 'views/Home.php';
      Layout(Home());
    }else{
      require_once 'views/Landing.php';
        Layout(Landing());
      }
    }
    
  public function MatchPage($match_id){
    // This logic is now handled by MatchesController@showMatchPage
    require_once 'views/Match.php';
    // The view needs a data array, so we pass an empty one to avoid errors.
    Layout(MatchPage(['match'=>[], 'team_a'=>[], 'team_b'=>[]]));
  }
}

?>