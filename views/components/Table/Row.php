<?php 
function Row($cells = []){
    $id = $cells['id'] ?? null;
?>
<tr id="user-row-<?php echo $id; ?>">

    <td class="size-px whitespace-nowrap">
        <div class="ps-6 py-3">
            <label for="hs-at-with-checkboxes-<?php echo $id; ?>" class="flex">
                <input type="checkbox"
                    class="shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 row-checkbox"
                    id="hs-at-with-checkboxes-<?php echo $id; ?>" data-id="<?php echo $id; ?>">
                <span class="sr-only">Checkbox</span>
            </label>
        </div>
    </td>

    <?php foreach ($cells as $key => $cellContent) {
        if ($key === 'id') continue; // Don't display the ID as a column
    ?>
    <td class="size-px whitespace-nowrap">
        <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
            <div class="gap-x-3">
                <div class="grow">
                    <span class="data-cell text-sm font-semibold text-gray-800 dark:text-neutral-200" data-field="<?php echo $key; ?>">
                        <?php echo $cellContent; ?>
                    </span>
                    <input type="text" class="edit-input hidden border-gray-300 rounded-sm" data-field="<?php echo $key; ?>" value="<?php echo $cellContent; ?>">
                </div>
            </div>
        </div>
    </td>
    <?php } ?>

    <td class="size-px whitespace-nowrap">
        <div class="px-6 py-1.5">
            <button type="button" class="edit-btn inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500" data-id="<?php echo $id; ?>">
                Edit
            </button>
            <button type="button" class="save-btn hidden inline-flex items-center gap-x-1 text-sm text-green-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-green-500" data-id="<?php echo $id; ?>">
                Save
            </button>
            <button type="button" class="delete-btn inline-flex items-center gap-x-1 text-sm text-red-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-red-500" data-id="<?php echo $id; ?>">
                Delete
            </button>
        </div>
    </td>
</tr>
<?php 
} 
?>
