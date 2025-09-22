<?php
function Home() { 
  
  ?>
    <h1>Home, Hola 
      <?php echo $_SESSION["user_id"];?>
      <?php echo $_SESSION["user_name"];?>
      <?php echo $_SESSION["user_role"];?>
    </h1>
    <form action="/api/auth/logout" method="post">
      <input type="submit" value="cerrar sesion">
    </form>


<?php } ?>
