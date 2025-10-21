import { Popup } from './Popup.js';

export class AlertPopup extends Popup {
    constructor(message) {
        const content = `<p class="text-gray-500 text-center py-4">${message}</p>`;
        super('Aviso', content);
    }
}
