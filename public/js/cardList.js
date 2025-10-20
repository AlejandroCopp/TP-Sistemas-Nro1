import { cardFactory } from './components/CardFactory.js';

/**
 * Creates a list of item cards and renders them into a specified container.
 * This component depends on cardFactory to render individual items.
 * @param {Array<object>} items - An array of item data objects to display.
 * @param {string} containerSelector - The CSS selector for the container element.
 */
export function createCardList(items, containerSelector) {
    console.log("createCardList@params[items]: ",items)
    const container = document.querySelector(containerSelector);
    if (!container) {
        console.error(`CardList Error: Container element '${containerSelector}' not found.`);
        return;
    }

    // If there are no items, display a message.
    if (!items || items.length === 0) {
        container.innerHTML = '<p class="text-center text-gray-500 dark:text-neutral-400">No hay partidos para mostrar.</p>';
        return;
    }

    // Create the HTML for each card and join them together.
    const listContent = items.map((item) => {
        return `<a href=/match/${item.id} >
        ${cardFactory(item).outerHTML}
        </a>`
    }).join('');

    // Render the list into the container.
    container.innerHTML = `
        <div class="grid grid-cols-1 gap-4">
            ${listContent}
        </div>
    `;
}