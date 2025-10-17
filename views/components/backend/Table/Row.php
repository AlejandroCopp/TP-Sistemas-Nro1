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
                    <?php if ($key === 'role'): ?>
                        <select class="edit-input hidden py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" data-field="<?php echo $key; ?>">
                            <option value="admin" <?php echo ($cellContent === 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="jugador" <?php echo ($cellContent === 'jugador') ? 'selected' : ''; ?>>Jugador</option>
                        </select>
                    <?php else: ?>
                        <input type="text" class="edit-input hidden py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" data-field="<?php echo $key; ?>" value="<?php echo $cellContent; ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </td>
    <?php } ?>

    <td class="size-px whitespace-nowrap">
        <div class="px-6 py-1.5 flex gap-x-2">
            <button type="button" class="edit-btn py-1 px-2 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-gray-200 bg-white text-blue-600 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-blue-500 dark:hover:bg-neutral-800" data-id="<?php echo $id; ?>">
                Edit
            </button>
            <button type="button" class="save-btn hidden py-1 px-2 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-gray-200 bg-white text-green-600 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-green-500 dark:hover:bg-neutral-800" data-id="<?php echo $id; ?>">
                Save
            </button>
            <button type="button" class="delete-btn py-1 px-2 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-gray-200 bg-white text-red-500 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-red-500 dark:hover:bg-neutral-800" data-id="<?php echo $id; ?>">
                Delete
            </button>
        </div>
    </td>
</tr>
<?php 
} 
?>
