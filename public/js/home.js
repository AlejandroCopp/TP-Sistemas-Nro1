import { NewMatchForm } from './components/NewMatchForm.js';

document.addEventListener('DOMContentLoaded', () => {
    const crearPartidoBtn = document.getElementById('crear-partido-btn');
    const searchEngineContainer = document.getElementById('search-engine-container');
    const formContainer = document.getElementById('form-container');

    if (crearPartidoBtn && searchEngineContainer && formContainer) {
        crearPartidoBtn.addEventListener('click', () => {
            // Hide the search engine and show the form container
            searchEngineContainer.style.display = 'none';
            formContainer.style.display = 'block';

            // Call NewMatchForm to render the form inside the container
            NewMatchForm('#form-container', () => {
                // Callback to show the search engine again
                searchEngineContainer.style.display = 'block';
                formContainer.style.display = 'none';
                formContainer.innerHTML = ''; // Clear the form
            });
        });
    }
});