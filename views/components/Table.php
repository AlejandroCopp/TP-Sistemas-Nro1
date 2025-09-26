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
                                <button type="button" id="delete-selected-btn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-600 bg-transparent text-red-600 hover:bg-red-50 disabled:opacity-50 disabled:pointer-events-none hidden">
                                    Delete Selected
                                </button>
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

                                <th class="size-px whitespace-nowrap">
                                    <div class="ps-6 py-3">
                                        <label for="select-all-checkbox" class="flex">
                                            <input type="checkbox"
                                                class="shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                id="select-all-checkbox">
                                            <span class="sr-only">Checkbox</span>
                                        </label>
                                    </div>
                                </th>

                                <?php
                                foreach ($headers as $position => $title) {
                                  if ($title === 'id') continue;
                                  echo '<th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                  <div class="flex items-center gap-x-2">
                                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">'
                                      . $title .
                                      '</span>
                                  </div> </th>'
                                 ;
                                } 
                                ?>
                                <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                  <div class="flex items-center gap-x-2">
                                      <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Action</span>
                                  </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Fin Titulos -->

                        <!-- body -->
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                            <?php 
                            foreach ($rows as $position => $rowContent) {
                              echo Row ($rowContent) ;
                            }?>

                        </tbody>
                        <!-- End body -->

                </div>
            </div>
        </div>
    </div>
</div>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = document.querySelector('table');
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const rowCheckboxes = table.querySelectorAll('.row-checkbox');
        const deleteSelectedBtn = document.getElementById('delete-selected-btn');

        function updateDeleteButtonVisibility() {
            const selectedCheckboxes = table.querySelectorAll('.row-checkbox:checked');
            if (selectedCheckboxes.length > 0) {
                deleteSelectedBtn.classList.remove('hidden');
            } else {
                deleteSelectedBtn.classList.add('hidden');
            }
        }

        selectAllCheckbox.addEventListener('change', function () {
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateDeleteButtonVisibility();
        });

        rowCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (!checkbox.checked) {
                    selectAllCheckbox.checked = false;
                } else {
                    const allChecked = Array.from(rowCheckboxes).every(c => c.checked);
                    selectAllCheckbox.checked = allChecked;
                }
                updateDeleteButtonVisibility();
            });
        });
        
        deleteSelectedBtn.addEventListener('click', function () {
            const selectedIds = Array.from(table.querySelectorAll('.row-checkbox:checked')).map(cb => cb.dataset.id);
            
            if (selectedIds.length > 0 && confirm(`Are you sure you want to delete ${selectedIds.length} selected users?`)) {
                fetch(`/api/admin/users`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ ids: selectedIds }),
                })
                .then(response => {
                    if (response.ok) {
                        selectedIds.forEach(id => {
                            document.getElementById(`user-row-${id}`).remove();
                        });
                        updateDeleteButtonVisibility();
                        selectAllCheckbox.checked = false;
                    } else {
                        alert('Failed to delete selected users.');
                    }
                })
                .catch(error => {
                    console.error('Error deleting users:', error);
                    alert('An error occurred while deleting users.');
                });
            }
        });

        table.addEventListener('click', function (e) {
            if (e.target.classList.contains('edit-btn')) {
                handleEditClick(e.target);
            }
            if (e.target.classList.contains('save-btn')) {
                handleSaveClick(e.target);
            }
            if (e.target.classList.contains('delete-btn')) {
                handleDeleteClick(e.target);
            }
        });

        function handleEditClick(editBtn) {
            const row = editBtn.closest('tr');
            toggleEditMode(row, true);
        }

        function handleSaveClick(saveBtn) {
            const row = saveBtn.closest('tr');
            const id = saveBtn.dataset.id;
            const data = {};

            const inputs = row.querySelectorAll('.edit-input');
            inputs.forEach(input => {
                // Only include name and email in the patch data, as per the comment
                if(input.dataset.field === 'name' || input.dataset.field === 'email'){
                    data[input.dataset.field] = input.value;
                }
            });

            fetch(`/api/admin/user/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(updatedData => {
                // Update the UI with the new data
                const cells = row.querySelectorAll('.data-cell');
                cells.forEach(cell => {
                    const field = cell.dataset.field;
                    if (updatedData[field]) {
                        cell.textContent = updatedData[field];
                    }
                });
                toggleEditMode(row, false);
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
                // Optionally, revert UI changes or show an error message
                toggleEditMode(row, false); // Revert to view mode on error
            });
        }

        function handleDeleteClick(deleteBtn) {
            const id = deleteBtn.dataset.id;
            if (confirm(`Are you sure you want to delete user ${id}?`)) {
                fetch(`/api/admin/user/${id}`, {
                    method: 'DELETE',
                })
                .then(response => {
                    if (response.ok) {
                        deleteBtn.closest('tr').remove();
                    } else {
                        alert('Failed to delete user.');
                    }
                })
                .catch(error => {
                    console.error('Error deleting user:', error);
                    alert('An error occurred while deleting the user.');
                });
            }
        }

        function toggleEditMode(row, isEditing) {
            const dataCells = row.querySelectorAll('.data-cell');
            const editInputs = row.querySelectorAll('.edit-input');
            const editBtn = row.querySelector('.edit-btn');
            const saveBtn = row.querySelector('.save-btn');

            dataCells.forEach(cell => {
                // Only make name and email editable
                if(cell.dataset.field === 'name' || cell.dataset.field === 'email'){
                    cell.classList.toggle('hidden', isEditing);
                }
            });

            editInputs.forEach(input => {
                if(input.dataset.field === 'name' || input.dataset.field === 'email'){
                    input.classList.toggle('hidden', !isEditing);
                }
            });

            editBtn.classList.toggle('hidden', isEditing);
            saveBtn.classList.toggle('hidden', !isEditing);
        }
    });
</script>

<?php ;}?>