<?php
// require_once __DIR__ . '/components/Table.php';
// require_once __DIR__ . '/components/HeaderComponent.php';
function Layout($content){

  // logica del componente


 ?>
 <!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Apuestas del Potrero | Apuestas Claras, Amistades Largas</title>
    <!-- tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- preline -->
     <script src="
    https://cdn.jsdelivr.net/npm/preline@3.2.3/dist/preline.min.js
    "></script>
    <!-- Google Fonts: Inter -->
    <link href="/public/preline.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="">

    <?php $content ?>


</body>
</html>


<?php ;}?>