import { CardList } from './CardList.js';
import { fetchMatches } from '../api.js';
import { sanitize } from '../utils.js';
import { createFilterBar } from './FilterBar.js';

/**
 * Creates and renders the search engine UI, including a search input and a "Join Match" button.
 * It also manages the filtering and rendering of match cards based on user input.
 * @param {string} containerSelector - The CSS selector for the container element where the search engine will be placed.
 */
export function createSearchEngine(containerSelector) {
    const container = document.querySelector(containerSelector);
    if (!container) {
        console.error(`SearchEngine Error: Container element '${containerSelector}' not found.`);
        return;
    }

    let allMatches = []; // Internal state to store all fetched matches
    let currentSearchTerm = ''; // Store the current search term
    let currentFilters = { horario: [], ubicacion: [], cantJug: [] }; // Store current filter selections

    const filterBarContainerSelector = '#filter-bar-container';
    const cardListContainerSelector = '#card-list-container';

    container.innerHTML = `
        <div class="max-w-lg mx-auto space-y-4 my-4">
            <!-- Search Input and Button -->
            <div class="flex gap-2">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                    </div>
                    <input type="text" id="search-input" class="py-3 ps-10 pe-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Ingresar ID, hora, Lugar o equipo">
                </div>
                <button type="button" id="search-button" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                    Buscar
                </button>
            </div>

            <!-- Join Button -->
            <button type="button" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tournament" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                   <path d="M5 4h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4"></path>
                   <path d="M5 14h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4"></path>
                   <path d="M10 7.5h4l4 4h-4"></path>
                   <path d="M10 16.5h4l4 -4h-4"></path>
                   <path d="M15 11.5l4.5 0"></path>
                </svg>
                Unirse a un Partido
            </button>

            <!-- Filter Bar Container -->
            <div id="filter-bar-container"></div>

            <!-- Card List Container: This is where the search results (cards) will be injected. -->
            <div id="card-list-container" class="space-y-4">
                <!-- Initial loading message -->
                <p class="text-center text-gray-500 dark:text-neutral-400">Cargando partidos...</p>
            </div>
        </div>
    `;

    const searchInput = container.querySelector('#search-input');
    const searchButton = container.querySelector('#search-button');
    const cardListContainer = container.querySelector(cardListContainerSelector);

    /**
     * Extracts unique values for filter options from a list of matches.
     * @param {Array<object>} matches - The list of match objects.
     * @returns {object} An object with arrays of unique values for each filter category.
     */
    const extractFilterOptions = (matches) => {
        console.log("extractFilterOptions @input: ",matches)
        const horarios = [...new Set(matches.map(match => match.dateTime))].sort();
        const ubicaciones = [...new Set(matches.map(match => match.location))].sort();
        const cantJugs = [...new Set(matches.map(match => match.playerCount))].sort();
        console.log("extractFilterOptions @output: ",{ horario: horarios, ubicacion: ubicaciones, cantJug: cantJugs })
        return { horario: horarios, ubicacion: ubicaciones, cantJug: cantJugs };
    };

    /**
     * Applies current search term and selected filters to the allMatches array and renders the card list.
     */
    const applyFiltersAndRender = () => {
        let filteredMatches = allMatches;

        // Apply search term filter
        if (currentSearchTerm) {
            const sanitizedSearchTerm = sanitize(currentSearchTerm).toLowerCase();
            filteredMatches = filteredMatches.filter(match => {
                return Object.values(match).some(value =>
                    String(value).toLowerCase().includes(sanitizedSearchTerm)
                );
            });
        }

        // Apply dropdown filters
        for (const filterType in currentFilters) {
            const selectedValues = currentFilters[filterType];
            if (selectedValues && selectedValues.length > 0) {
                filteredMatches = filteredMatches.filter(match =>
                    selectedValues.includes(match[filterType])
                );
            }
        }
        
        CardList(filteredMatches, cardListContainerSelector);
    };

    /**
     * Handles changes in the filter bar.
     * @param {object} newFilters - An object containing the newly selected filter values.
     */
    const handleFilterChange = (newFilters) => {
        currentFilters = { ...currentFilters, ...newFilters };
        applyFiltersAndRender();
    };

    // Event listener for the search button
    if (searchButton && searchInput) {
        searchButton.addEventListener('click', () => {
            currentSearchTerm = searchInput.value; // Update current search term
            applyFiltersAndRender();
        });
    }

    // Initial load: fetch all matches and set up filters
    (async () => {
        try {
            const fetchedMatches = await fetchMatches();
            allMatches = fetchedMatches; // Store all fetched matches
            
            // Extract filter options and render the filter bar
            const filterOptions = extractFilterOptions(allMatches);
            createFilterBar(filterBarContainerSelector, filterOptions, handleFilterChange);

            applyFiltersAndRender(); // Render all matches initially
        } catch (error) {
            console.error("Failed to fetch and render matches in SearchEngine:", error);
            if (cardListContainer) {
                cardListContainer.innerHTML = '<p class="text-center text-red-500">Error al cargar los partidos. Por favor, intente de nuevo más tarde.</p>';
            }
        }
    })();
}
