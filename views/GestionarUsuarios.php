<?php

require_once "./views/components/UsersTable.php";

function GestionarUsuarios(){

    // logica del componente

    ?>

<!-- Table Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <?php UsersTable(["name", "Status", "Created"],[
  "avatar" => "url_a_imagen",
  "name" => "Christina Bersh",
  "email" => "christina@site.com",
  "status" => "Active",
  "created" => "28 Dec, 12:12"
]);?>
  
  <!-- End Card -->
</div>
<!-- End Table Section --><!-- End Table Section -->

<?php ;}?>