<?php

require_once __DIR__ . '/components/Table.php';

function GestionarUsuarios($headers, $users){
    ?>

<!-- Table Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <?php Table($headers, $users);?>
  
  <!-- End Card -->
</div>
<!-- End Table Section --><!-- End Table Section -->

<?php ;}?>