import { InputField } from './form/InputField.js';
import { SelectField } from './form/SelectField.js';

// Function to render the entire form structure as a string
function renderForm() {
    const tiposDeFutbol = {'10': 'Fútbol 5', '14': 'Fútbol 7', '22': 'Fútbol 11'};
    
    return `
        <form id="newMatchForm" class="space-y-4 p-6 bg-white rounded-xl shadow-lg border">
            <h2 class="text-xl font-bold text-gray-800">Crear Nuevo Partido</h2>
            <div id="form-feedback"></div>
            ${InputField('Nombre del equipo 1', 'text', 'team_name1', 'team_name1', 'Ej: Boca')}
            ${InputField('Nombre del equipo 2', 'text', 'team_name2', 'team_name2', 'Ej: River Plate')}
            ${InputField('Ubicación', 'text', 'location', 'location', 'Ej: Cancha "El Potrero"')}
            ${InputField('Fecha y Hora', 'datetime-local', 'datetimeScheduled', 'datetimeScheduled')}
            ${SelectField('Cantidad de Jugadores', 'maxPlayers', 'maxPlayers', tiposDeFutbol)}
            <div class="flex flex-col sm:flex-row-reverse items-center gap-3 mt-4">
                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 text-white font-medium rounded-lg shadow-sm bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Crear Partido
                </button>
                <button type="button" id="back-button" class="w-full inline-flex items-center justify-center px-4 py-2 text-gray-700 font-medium rounded-lg shadow-sm bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    Volver
                </button>
            </div>
        </form>
    `;
}

/**
 * Main component function for the New Match Form.
 * Renders the form and handles its logic.
 * @param {string} containerSelector - The selector for the container where the form will be rendered.
 * @param {function} onVolver - Callback function executed when the 'Volver' button is clicked.
 */
export function NewMatchForm(containerSelector, onVolver) {
    const container = document.querySelector(containerSelector);
    if (!container) {
        console.error(`NewMatchForm Error: Container element '${containerSelector}' not found.`);
        return;
    }

    // 1. Render the HTML
    container.innerHTML = renderForm();

    // 2. Get references to the new elements
    const form = container.querySelector('#newMatchForm');
    const backButton = container.querySelector('#back-button');
    const feedbackDiv = container.querySelector('#form-feedback');

    // 3. Attach event listeners
    if (backButton && onVolver) {
        backButton.addEventListener('click', onVolver);
    }

    if (form) {
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            feedbackDiv.textContent = '';
            feedbackDiv.className = 'hidden';

            const formData = new FormData(form);
            
            const dateTimeValue = formData.get('datetimeScheduled');
            if (!dateTimeValue) {
                feedbackDiv.textContent = 'Por favor, selecciona una fecha y hora.';
                feedbackDiv.className = 'p-2 my-2 text-sm text-white bg-red-500 rounded-lg';
                return;
            }
            const timestamp = Math.floor(new Date(dateTimeValue).getTime() / 1000);
            formData.set('datetimeScheduled', timestamp);

            try {
                const response = await fetch('/api/match', {
                    method: 'POST',
                    body: new URLSearchParams(formData)
                });

                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({ message: 'Ocurrió un error desconocido.' }));
                    throw new Error(errorData.message || 'Error al crear el partido.');
                }

                feedbackDiv.textContent = '¡Partido creado con éxito!';
                feedbackDiv.className = 'p-2 my-2 text-sm text-white bg-green-500 rounded-lg';

                setTimeout(() => {
                    if (onVolver) {
                        onVolver();
                    }
                }, 1500);

            } catch (error) {
                feedbackDiv.textContent = error.message;
                feedbackDiv.className = 'p-2 my-2 text-sm text-white bg-red-500 rounded-lg';
            }
        });
    }
}
