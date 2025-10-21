import { sanitize } from '../utils.js';

/**
 * Creates the HTML for a single match item card.
 * This component is self-contained and only responsible for displaying the data it receives.
 * @param {object} itemData - The data for the match.
 * @returns {string} The HTML string for the item card.
 * 
 * itemData = {
 * 
 * }
 * 
 */
export function MatchCardComponent(itemData) {
    const now = new Date();
    // Expecting a Unix timestamp in seconds, so multiply by 1000 for milliseconds
    const scheduledDate = new Date(itemData.scheduled * 1000);

    const thirtyMinBefore = new Date(scheduledDate.getTime() - 30 * 60 * 1000);
    const ninetyMinAfter = new Date(scheduledDate.getTime() + 90 * 60 * 1000);

    let status = 'Programado';
    let statusBgColor = 'bg-gray-100 dark:bg-gray-700';
    let statusTextColor = 'text-gray-800 dark:text-gray-200';

    if (now >= scheduledDate && now <= ninetyMinAfter) {
        status = 'Jugando';
        statusBgColor = 'bg-green-100 dark:bg-green-900';
        statusTextColor = 'text-green-800 dark:text-green-200';
    } else if (now >= thirtyMinBefore && now < scheduledDate) {
        status = 'Por comenzar';
        statusBgColor = 'bg-yellow-100 dark:bg-yellow-700';
        statusTextColor = 'text-yellow-800 dark:text-yellow-200';
    } else if (now > ninetyMinAfter) {
        status = 'Finalizado';
        statusBgColor = 'bg-red-100 dark:bg-red-700';
        statusTextColor = 'text-red-800 dark:text-red-200';
    }
    
    const formattedDate = scheduledDate.toLocaleString('es-AR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    }) + ' hs';

    return `
        <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-md overflow-hidden p-4 border border-gray-200 dark:border-neutral-700 hover:shadow-xl transition-shadow duration-300">
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="col-span-9">
                    <div class="flex flex-col justify-between h-full">
                        <div class="flex items-center text-sm text-gray-500 dark:text-neutral-400 mb-2">
                            <span class="text-3xl font-bold text-black">${sanitize(itemData.matchType)} </span>
                            <span class=" mx-2 text-2xl font-semibold"> [${itemData.actualPlayers}/${sanitize(itemData.maxPlayers)}] </span>
                        </div>
                        <div class="flex items-baseline gap-x-3 my-1">
                            <span class="text-xl font-semibold text-gray-700 dark:text-neutral-300"><span class="mx-2">📍</span>
                            <span>${sanitize(itemData.location)}</span></span>
                        </div>
                        <div class="flex items-center gap-x-4 text-sm text-gray-600 dark:text-neutral-400 mt-2">
                            <span class="font-medium"></span>
                            <span class="font-medium">${ sanitize(formattedDate) }</span>
                            <span class="px-2 py-1 text-xs font-bold rounded-md ${statusBgColor} ${statusTextColor}">
                                ${sanitize(status)}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 h-full">
                    <img src="${sanitize(itemData.imageUrl)}" alt="Foto del lugar" class="w-full h-full object-cover rounded-lg">
                </div>
            </div>
        </div>
    `;
}