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
    session_start();
    if(isset($_SESSION["user_id"])){
      require_once 'views/Home.php';
      Layout(Home());
    }else{
      require_once 'views/Landing.php';
        Layout(Landing());
    }
  }
}

?>