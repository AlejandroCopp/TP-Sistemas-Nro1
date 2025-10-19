


<!-- 
<!DOCTYPE html>
<html lang="es">

<body class="bg-gray-100 p-5">

  <h1 class="text-2xl font-bold mb-4">Partidos</h1>
  <div id="contenedor-partidos"></div>
  
  <!-- Script de la tarjeta -->
  <!-- <script src="public/js/CrearTarjeta.js"></script>
  
  </body>
  </html> -->
   
<?php 
function Home() { 
?>
    <h1 class="text-2xl font-bold my-4 text-center">Bienvenido <?php echo $_SESSION["role"]." ". $_SESSION["name"];?></h1>

    <div id="search-engine-container" class="p-4 max-w-2xl mx-auto"></div>
    <script type="module" src="public/js/index.js"></script>
<?php 
} 
?>