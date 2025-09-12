<?php function Row($cells = []){?>
  <tr>
    <?php foreach ($cells as $position => $cellContent) {
      echo "<td>$cellContent</td>";
    }?>
  </tr>
<?php ;} ?>
