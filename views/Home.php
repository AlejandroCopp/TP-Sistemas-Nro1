<?php
function Home($usuario){ 
  session_start();
  $_SESSION["name"]=$usuario;
  if(isset($_SESSION["name"])){
  ?>
    <h1>Home, Hola <?$_SESSION["name"]?></h1>
  <? }else{
    header("/login"); 
  }?>


<?php }?>
