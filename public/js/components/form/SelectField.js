/**
 * Renders an HTML select field as a string.
 * @param {string} labelText - The text for the label.
 * @param {string} selectId - The ID for the select and the 'for' attribute of the label.
 * @param {string} selectName - The name attribute for the select.
 * @param {object} options - An object of value-text pairs for the options.
 * @returns {string} The HTML string for the select field.
 */
export function SelectField(labelText, selectId, selectName, options) {
    const optionsHtml = Object.entries(options)
        .map(([value, text]) => `<option value="${value}">${text}</option>`)
        .join('');

    return `
        <div class="flex flex-col">
            <label for="${selectId}" class="mb-1 text-sm font-medium text-gray-700">${labelText}</label>
            <select id="${selectId}" name="${selectName}" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-shadow" required>
                <option value="" disabled selected>Seleccionar...</option>
                ${optionsHtml}
            </select>
        </div>
    `;
}
