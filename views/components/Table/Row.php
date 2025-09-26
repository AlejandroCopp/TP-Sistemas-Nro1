<?php function Row($cells = []){?>
<tr>

    <td class="size-px whitespace-nowrap">
        <div class="ps-6 py-3">
            <label for="hs-at-with-checkboxes-1" class="flex">
                <input type="checkbox"
                    class="shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                    id="hs-at-with-checkboxes-1">
                <span class="sr-only">Checkbox</span>
            </label>
        </div>
    </td>

    <?php foreach ($cells as $position => $cellContent) { ?>
    <td class="size-px whitespace-nowrap ">
        <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
            <div class=" gap-x-3">
                <div class="grow">
                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                        <?php
                          echo "$cellContent";
                          ?>
                    </span>
                </div>
            </div>
        </div>
    </td>

    <?php }?>
</tr>
<?php ;} ?>