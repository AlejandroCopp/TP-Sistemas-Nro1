/**
 * Renders an HTML input field as a string.
 * @param {string} labelText - The text for the label.
 * @param {string} inputType - The type of the input (e.g., 'text', 'datetime-local').
 * @param {string} inputId - The ID for the input and the 'for' attribute of the label.
 * @param {string} inputName - The name attribute for the input.
 * @param {string} [placeholder=''] - The placeholder text for the input.
 * @returns {string} The HTML string for the input field.
 */
export function InputField(labelText, inputType, inputId, inputName, placeholder = '') {
    return `
        <div class="flex flex-col">
            <label for="${inputId}" class="mb-1 text-sm font-medium text-gray-700">${labelText}</label>
            <input type="${inputType}" id="${inputId}" name="${inputName}" placeholder="${placeholder}" class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-shadow" required>
        </div>
    `;
}
