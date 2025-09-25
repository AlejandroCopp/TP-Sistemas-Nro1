<?php
require_once __DIR__ . '/Table/Row.php';
function Table($headers, $rows = []){

?>


<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Card -->
    <div class="flex flex-col">
        <div
            class="overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
            <div class="min-w-full inline-block align-middle">
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">

                    <!-- Header -->
                    <div
                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                Users
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Add users, edit and more.
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    href="#">
                                    View all
                                </a>

                                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    href="#">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Add user
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <!-- Titulos -->
                        <thead class="bg-gray-50 dark:bg-neutral-800">
                            <tr>
                                <th scope="col" class="ps-6 py-3 text-start">
                                    <label for="hs-at-with-checkboxes-main" class="flex">
                                        <input type="checkbox"
                                            class="shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="hs-at-with-checkboxes-main">
                                        <span class="sr-only">Checkbox</span>
                                    </label>
                                </th>

                                <?php
                      foreach ($headers as $position => $title) {
                        echo '<th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">'
                            . $title .
                            '</span>
                        </div>';
                        
                      } 
                      ?>
                            </tr>
                        </thead>
                        <!-- Fin Titulos -->

                        <!-- body -->
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">




                            <?php
                  foreach ($rows as $postition => $rowContent): ?>

                            <tr>

                                <td>
                                    <h1>hola</h1>

                                </td>


                                <td class="size-px whitespace-nowrap">
                                    <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                        <div class="flex items-center gap-x-3">
                                            <div class="grow">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                    <?= Row ($rowContent) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>


                            <?php endforeach; ?>

                        </tbody>
                        <!-- End body -->

                </div>
            </div>
        </div>
    </div>
</div>
</table>

<?php ;}?>