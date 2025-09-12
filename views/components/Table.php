<?php
require_once __DIR__ . '/Table/Row.php';
function Table($headers, $rows = []){

?>

<table>
  <thead>
    <?php
      foreach ($headers as $position => $title) {
        echo "<th> $title </th>"; 
      } 
    ?>
  </thead>
  <tbody>
    <?php
      foreach ($rows as $postition => $rowContent){
        Row($rowContent);
      }
    ?>
  </tbody>
</table>
<?php ;}?>