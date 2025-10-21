import { CardFactory } from './CardFactory.js';

/**
 * Creates a list of item cards and renders them into a specified container.
 * This component depends on cardFactory to render individual items.
 * @param {Array<object>} items - An array of item data objects to display.
 * @param {string} containerSelector - The CSS selector for the container element.
 */
export function CardList(items, containerSelector) {
    console.log("createCardList@params[items]: ",items)
    const container = document.querySelector(containerSelector);
    if (!container) {
        console.error(`CardList Error: Container element '${containerSelector}' not found.`);
        return;
    }

    // If there are no items, display a message.
    if (!items || items.length === 0) {
        container.innerHTML = '<p class="text-center text-gray-500 dark:text-neutral-400">No hay items para mostrar.</p>';
        return;
    }

    // Create the HTML for each card and join them together.
    const listContent = items.map((item) => {
        const card = CardFactory(item);
        if (!card) return '';

        // Only wrap 'partido' type cards in a link
        if (item.tipo === 'partido' && item.id) {
            return `<a href="/match/${item.id}">${card.outerHTML}</a>`;
        }
        
        return card.outerHTML;
    }).join('');

    // Render the list into the container.
    container.innerHTML = `
        <div class="grid grid-cols-1 gap-2">
            ${listContent}
        </div>
    `;
}