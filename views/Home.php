<?php
require_once __DIR__ . '/components/Table.php';
function Home(){

  // logica del componente



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php $fila ?>
</head>
<body>
  <?php Table(["titulo 1", "titulo 2", "titulo 3"],
  [
    ["celda 1", "celda 2", "celda 3"]
  ]); ?>
</body>
</html>
<?php ;}?>