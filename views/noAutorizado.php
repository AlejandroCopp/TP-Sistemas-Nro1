<?php
  function noAutorizado($role){
    echo "no autorizado, el nivel requerido es $role tu eres ".$_SESSION['role'];
  }
?>
<form action="/login">
  <button type="submit">volver al login</button>
</form>