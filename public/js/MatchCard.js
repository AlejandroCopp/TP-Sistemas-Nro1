/**
 * Generates an HTML match card component and appends it to a container.
 *
 * @param {object} props An object containing the properties for the match card.
 *                      - location (string): The location of the match.
 *                      - date (string): The date of the match (e.g., 'Hoy').
 *                      - time (string): The time of the match (e.g., '18:00 hs').
 *                      - matchType (string): The type of match (e.g., '5 vs 5').
 *                      - isPlaying (bool): The status of the match (true if playing, false if pending).
 *                      - mode (string): The view mode, 'user' or 'admin'.
 * @param {HTMLElement} container The container element to append the card to.
 */
function MatchCard(props, container) {
    const {
        location = 'Ubicación no definida',
        date = 'Fecha no definida',
        time = 'Hora no definida',
        matchType = '5 vs 5',
        isPlaying = false,
        mode = 'user'
    } = props;

    const statusText = isPlaying ? 'Jugando' : 'Pendiente';
    const statusClasses = isPlaying 
        ? 'border-green-500 text-green-500' 
        : 'border-yellow-500 text-yellow-500';

    const primaryButtonText = mode === 'admin' ? 'Ver Postulaciones' : 'Unirse';

    const card = document.createElement('div');
    card.className = 'p-4 bg-white rounded-lg shadow-lg border border-gray-200 max-w-sm mx-auto';

    card.innerHTML = `
        <div class="grid grid-cols-3 gap-2 items-start mb-3">
            <div class="col-span-2 flex items-center space-x-2">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-5.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                <p class="text-gray-800 font-semibold">${location}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">${date}</p>
                <p class="text-base font-bold text-gray-800">${time}</p>
            </div>
        </div>

        <div class="flex items-center space-x-3 mb-4">
            <p class="text-lg text-gray-900 font-bold">${matchType}</p>
            <span class="px-3 py-1 text-sm font-semibold rounded-md border ${statusClasses}">${statusText}</span>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <button class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ${primaryButtonText}
            </button>
            <button class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Compartir
            </button>
        </div>
    `;

    // Clear container and append new card
    if (container) {
        container.innerHTML = '';
        container.appendChild(card);
    }
}
