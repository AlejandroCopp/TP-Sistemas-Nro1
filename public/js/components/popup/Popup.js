export class Popup {
    constructor(title, contentHtml) {
        this.title = title;
        this.contentHtml = contentHtml;
        this.modalElement = null;
        this._createModal();
    }

    _render() {
        return `
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                <div class="space-y-4 p-6 bg-white rounded-xl shadow-lg border dark:bg-neutral-800 w-full max-w-sm">
                    <div class="flex justify-between items-center">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-neutral-200">${this.title}</h3>
                        <button type="button" class="close-popup-btn text-gray-500 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    ${this.contentHtml}
                </div>
            </div>
        `;
    }

    _createModal() {
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = this._render();
        this.modalElement = tempDiv.firstElementChild;
        this.modalElement.querySelector('.close-popup-btn').addEventListener('click', () => this.close());
    }

    open() {
        document.body.appendChild(this.modalElement);
    }

    close() {
        this.modalElement.remove();
    }
}
