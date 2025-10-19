import { sanitize } from './utils.js';

/**
 * Creates and renders a filter bar with dropdowns for various match properties.
 * @param {string} containerSelector - The CSS selector for the container element where the filter bar will be placed.
 * @param {object} filterOptions - An object containing arrays of unique options for each filter category.
 * @param {Array<string>} filterOptions.horario - Unique date/time strings.
 * @param {Array<string>} filterOptions.ubicacion - Unique location strings.
 * @param {Array<string>} filterOptions.cantJug - Unique player count strings.
 * @param {function(object): void} onFilterChange - Callback function to be called when a filter selection changes.
 *                                                  It receives an object with the current filter selections.
 */
export function createFilterBar(containerSelector, filterOptions, onFilterChange) {
    const container = document.querySelector(containerSelector);
    if (!container) {
        console.error(`FilterBar Error: Container element '${containerSelector}' not found.`);
        return;
    }

    // Helper to generate dropdown items
    const generateDropdownItems = (options, filterType) => {
        if (!options || options.length === 0) {
            return `<a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300" href="#">No options available</a>`;
        }
        return options.map(option => `
            <label for="hs-dropdown-item-filter-${filterType}-${sanitize(option)}" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300">
                <input type="checkbox" id="hs-dropdown-item-filter-${filterType}-${sanitize(option)}" name="${filterType}" value="${sanitize(option)}" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                ${sanitize(option)}
            </label>
        `).join('');
    };

    container.innerHTML = `
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200 mb-2">Filtros</h2>
            <div class="flex flex-wrap gap-2 items-center">

                <!-- Horario Filter Dropdown -->
                <div class="hs-dropdown relative inline-flex [--placement:bottom-left]">
                    <button id="hs-dropdown-horario" type="button" class="hs-dropdown-toggle py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                        Horario
                        <svg class="hs-dropdown-open:rotate-180 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="hs-dropdown-menu w-48 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700" aria-labelledby="hs-dropdown-horario">
                        ${generateDropdownItems(filterOptions.horario, 'horario')}
                    </div>
                </div>

                <!-- Ubicación Filter Dropdown -->
                <div class="hs-dropdown relative inline-flex [--placement:bottom-left]">
                    <button id="hs-dropdown-ubicacion" type="button" class="hs-dropdown-toggle py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                        Ubicación
                        <svg class="hs-dropdown-open:rotate-180 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="hs-dropdown-menu w-48 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700" aria-labelledby="hs-dropdown-ubicacion">
                        ${generateDropdownItems(filterOptions.ubicacion, 'ubicacion')}
                    </div>
                </div>

                <!-- Cant. Jug. Filter Dropdown -->
                <div class="hs-dropdown relative inline-flex [--placement:bottom-left]">
                    <button id="hs-dropdown-cantjug" type="button" class="hs-dropdown-toggle py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                        Cant. Jug.
                        <svg class="hs-dropdown-open:rotate-180 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="hs-dropdown-menu w-48 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700" aria-labelledby="hs-dropdown-cantjug">
                        ${generateDropdownItems(filterOptions.cantJug, 'cantJug')}
                    </div>
                </div>

                <!-- Add Filter Button -->
                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                    <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                </button>
            </div>
            <hr class="my-4 border-gray-200 dark:border-neutral-700">
        </div>
    `;

    // Attach event listeners for filter changes
    container.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selectedFilters = {};
            // Collect all selected filter values
            container.querySelectorAll('.hs-dropdown-menu').forEach(menu => {
                // Extract filter type from aria-labelledby (e.g., 'horario', 'ubicacion', 'cantjug')
                const filterType = menu.getAttribute('aria-labelledby').replace('hs-dropdown-', '');
                selectedFilters[filterType] = Array.from(menu.querySelectorAll(`input[name="${filterType}"]:checked`)).map(cb => cb.value);
            });
            onFilterChange(selectedFilters);
        });
    });
}
