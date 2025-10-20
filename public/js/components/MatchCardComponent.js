import { sanitize } from '../utils.js';

/**
 * Creates the HTML for a single match item card.
 * This component is self-contained and only responsible for displaying the data it receives.
 * @param {object} itemData - The data for the match.
 * @returns {string} The HTML string for the item card.
 */
export function createMatchCard(itemData) {
    // Determine status badge colors based on the match status
    const isPlaying = itemData.status && itemData.status.toLowerCase() === 'jugando';
    const statusBgColor = isPlaying ? 'bg-green-100 dark:bg-green-900' : 'bg-gray-100 dark:bg-gray-700';
    const statusTextColor = isPlaying ? 'text-green-800 dark:text-green-200' : 'text-gray-800 dark:text-gray-200';

    return `
        <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-md overflow-hidden p-4 border border-gray-200 dark:border-neutral-700 hover:shadow-xl transition-shadow duration-300">
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="col-span-9">
                    <div class="flex flex-col justify-between h-full">
                        <div class="flex items-center text-sm text-gray-500 dark:text-neutral-400 mb-2">
                            <span class="font-semibold">${sanitize(itemData.category)}</span>
                            <span class="mx-2">📍</span>
                            <span>${sanitize(itemData.location)}</span>
                        </div>
                        <div class="flex items-baseline gap-x-3 my-1">
                            <span class="text-3xl font-bold text-gray-800 dark:text-neutral-200">${sanitize(itemData.playerCount)}</span>
                            <span class="text-xl font-semibold text-gray-700 dark:text-neutral-300">${sanitize(itemData.title)}</span>
                        </div>
                        <div class="flex items-center gap-x-4 text-sm text-gray-600 dark:text-neutral-400 mt-2">
                            <span class="font-medium">${sanitize(itemData.matchType)}</span>
                            <span class="font-medium">${sanitize(itemData.dateTime)}</span>
                            <span class="px-2 py-1 text-xs font-bold rounded-md ${statusBgColor} ${statusTextColor}">
                                ${sanitize(itemData.status)}
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