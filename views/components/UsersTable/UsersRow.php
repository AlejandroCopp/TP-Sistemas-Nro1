<?php function UsersRow($cells = [
        "avatar" => "url_a_imagen",
        "name" => "Christina Bersh",
        "email" => "christina@site.com",
        "status" => "Active",
        "created" => "28 Dec, 12:12"
        
      ]){ 
        ?>
  <tr>
    <td class="size-px whitespace-nowrap">
      <div class="ps-6 py-3">
        <label for="hs-at-with-checkboxes-1" class="flex">
          <input type="checkbox" class="shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-at-with-checkboxes-1">
          <span class="sr-only">Checkbox</span>
        </label>
      </div>
    </td>

    <td class="size-px whitespace-nowrap">
      <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
        <div class="flex items-center gap-x-3">
          <img class="inline-block size-9.5 rounded-full" src="https://images.unsplash.com/photo-1531927557220-a9e23c1e4794?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Avatar">
          <div class="grow">
            <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200"><?php echo $cells["name"]?></span>
            <span class="block text-sm text-gray-500 dark:text-neutral-500"><?php echo $cells["email"]?></span>
          </div>
        </div>
      </div>
    </td>
    
    <td class="size-px whitespace-nowrap">
      <div class="px-6 py-3">
        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
          <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
          </svg>
          <?php echo $cells["status"]?>
        </span>
      </div>
    </td>
    
    <td class="size-px whitespace-nowrap">
      <div class="px-6 py-3">
        <span class="text-sm text-gray-500 dark:text-neutral-500"><?php echo $cells["created"]?></span>
      </div>
    </td>
    <td class="size-px whitespace-nowrap">
      <div class="px-6 py-1.5">
        <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" href="#">
          Edit
        </a>
      </div>
    </td>
  </tr>
<?php ;} ?>
