


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
    <div class="flex justify-center items-center my-4">
        <h1 class="text-2xl font-bold text-center">Bienvenido <?php echo $_SESSION["role"]." ". $_SESSION["name"];?></h1>
        <button id="crear-partido-btn" class="ml-4 py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Crear Partido</button>
    </div>
    <div id="main-container" class="p-4 max-w-2xl mx-auto">
        <div id="search-engine-container"></div>
        <div id="form-container" style="display: none;"></div>
    </div>
    <script type="module" src="public/js/index.js"></script>
    <script type="module" src="public/js/home.js"></script>
<?php 
} 
?>