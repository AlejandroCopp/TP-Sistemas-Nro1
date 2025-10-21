import { Popup } from './popup/Popup.js';

export class SharePopup extends Popup {
    constructor(matchId) {
        const shareUrl = `${window.location.origin}/match/${matchId}`;
        const contentHtml = `
            <p class="text-gray-500 text-center">
              Cualquiera con este link podrá ver los detalles del partido.
            </p>
            <div id="share-feedback" class="text-center h-6"></div>
            <div class="mt-5 flex flex-col items-center gap-2">
              <div class="relative w-full">
                <input id="share-link-input" type="text" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm bg-gray-100 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-400" value="${shareUrl}" readonly>
              </div>
              <button id="copy-button" type="button" class="py-3 px-4 w-full inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
                Copiar Link
              </button>
            </div>
        `;
        
        super('Compartir Partido', contentHtml);
        
        this.shareUrl = shareUrl;
        this._attachCopyLogic();
    }

    _attachCopyLogic() {
        // The modalElement is created by the parent Popup class
        const copyButton = this.modalElement.querySelector('#copy-button');
        const feedbackDiv = this.modalElement.querySelector('#share-feedback');

        if (copyButton) {
            copyButton.addEventListener('click', () => {
                navigator.clipboard.writeText(this.shareUrl).then(() => {
                    feedbackDiv.textContent = '¡Link copiado!';
                    feedbackDiv.className = 'p-2 text-sm text-green-500';
                    copyButton.textContent = '¡Copiado!';
                    setTimeout(() => {
                        feedbackDiv.textContent = '';
                        copyButton.textContent = 'Copiar Link';
                    }, 2000);
                }).catch(err => {
                    feedbackDiv.textContent = 'Error al copiar el link.';
                    feedbackDiv.className = 'p-2 text-sm text-red-500';
                    console.error('Failed to copy: ', err);
                });
            });
        }
    }
}