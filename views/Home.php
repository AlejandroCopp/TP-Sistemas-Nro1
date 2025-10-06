<?php
require_once "views/components/Table.php";  
require_once "models/UserModel.php";
require_once  "db/Database.php";
function Home() { 
  ?>
    <h1>Home, Hola 
      <?php echo $_SESSION["name"];?>
      <?php echo $_SESSION["role"];?>
    </h1>



    <?php 
      $database = new Database();
      $User = new UserModel($database->getConnection());
   
    $users = ($User -> getAllUsers()) ;

    $rows = [];
    foreach ($users as $user) {
      $rows[] = [
        $user['id'],
        $user['name'],
        $user['email'],
        $user['role'],
      ];
    }

    Table (["id","name","email","role"],$rows);
    ?> 
    <form action="/api/auth/logout" method="post">
      <input type="submit" value="cerrar sesion">
    </form>


<?php } ?>
