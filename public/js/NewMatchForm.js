/**
 * Crea y devuelve un formulario HTML para la creación de un nuevo partido.
 * @param {function} onVolver - Callback que se ejecuta al presionar el botón "Volver".
 * @returns {HTMLFormElement} El elemento del formulario.
 */
export function crearFormularioPartido(onVolver) {
  const form = document.createElement('form');
  form.className = 'space-y-4 p-6 bg-white rounded-xl shadow-lg border';
  form.id = 'newMatchForm';

  // Añadir un título al formulario
  const title = document.createElement('h2');
  title.textContent = 'Crear Nuevo Partido';
  title.className = 'text-xl font-bold text-gray-800';
  form.appendChild(title);

  // Creación de los campos del formulario
  form.appendChild(_crearCampoInput('Nombre de Equipo A', 'text', 'equipoA', 'equipoA', 'Ej: Los Halcones'));
  form.appendChild(_crearCampoInput('Nombre de Equipo B', 'text', 'equipoB', 'equipoB', 'Ej: Las Águilas'));
  form.appendChild(_crearCampoInput('Ubicación', 'text', 'ubicacion', 'ubicacion', 'Ej: Cancha "El Potrero"'));
  
  const dateTimeContainer = document.createElement('div');
  dateTimeContainer.className = 'grid grid-cols-1 md:grid-cols-3 gap-4';
  dateTimeContainer.appendChild(_crearCampoInput('Día', 'number', 'dia', 'dia', 'Ej: 25'));
  dateTimeContainer.appendChild(_crearCampoInput('Mes', 'text', 'mes', 'mes', 'Ej: Diciembre'));
  dateTimeContainer.appendChild(_crearCampoInput('Hora', 'time', 'hora', 'hora'));
  form.appendChild(dateTimeContainer);

  const tiposDeFutbol = ['Futbol 11', 'Futbol 7', 'Futbol 5', 'Futbol Sala'];
  form.appendChild(_crearCampoSelect('Tipo de Partido', 'tipo', 'tipo', tiposDeFutbol));

  // Contenedor para botones
  const buttonContainer = document.createElement('div');
  buttonContainer.className = 'flex flex-col sm:flex-row-reverse items-center gap-3 mt-4';

  // Botón de creación (submit)
  const submitButton = document.createElement('button');
  submitButton.type = 'submit';
  submitButton.textContent = 'Crear Partido';
  submitButton.className = 'w-full inline-flex items-center justify-center px-4 py-2 text-white font-medium rounded-lg shadow-sm bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors';
  
  // Botón para volver
  const backButton = document.createElement('button');
  backButton.type = 'button';
  backButton.textContent = 'Volver';
  backButton.className = 'w-full inline-flex items-center justify-center px-4 py-2 text-gray-700 font-medium rounded-lg shadow-sm bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors';
  if (onVolver) {
    backButton.addEventListener('click', onVolver);
  }

  buttonContainer.appendChild(submitButton);
  buttonContainer.appendChild(backButton);
  
  form.appendChild(buttonContainer);

  form.addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    console.log('Datos del partido:', data);
    alert('Partido creado (ver consola para detalles).');
    if (onVolver) {
        onVolver(); // Volver a la lista después de crear
    }
  });

  return form;
}

// --- Funciones Auxiliares (de NewMatch.js) ---

/**
 * Crea un contenedor de campo con label e input.
 * @private
 */
function _crearCampoInput(labelText, inputType, inputId, inputName, placeholder = '') {
  const div = document.createElement('div');
  div.className = 'flex flex-col';

  const label = document.createElement('label');
  label.textContent = labelText;
  label.htmlFor = inputId;
  label.className = 'mb-1 text-sm font-medium text-gray-700';

  const input = document.createElement('input');
  input.type = inputType;
  input.id = inputId;
  input.name = inputName;
  input.placeholder = placeholder;
  input.className = 'border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-shadow';
  if (inputType === 'number') {
    input.min = '1';
    input.max = '31';
  }

  div.appendChild(label);
  div.appendChild(input);
  return div;
}

/**
 * Crea un contenedor de campo con label y select.
 * @private
 */
function _crearCampoSelect(labelText, selectId, selectName, options) {
  const div = document.createElement('div');
  div.className = 'flex flex-col';

  const label = document.createElement('label');
  label.textContent = labelText;
  label.htmlFor = selectId;
  label.className = 'mb-1 text-sm font-medium text-gray-700';

  const select = document.createElement('select');
  select.id = selectId;
  select.name = selectName;
  select.className = 'border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-shadow';

  const placeholderOption = document.createElement('option');
  placeholderOption.value = '';
  placeholderOption.textContent = 'Seleccionar tipo...';
  placeholderOption.disabled = true;
  placeholderOption.selected = true;
  select.appendChild(placeholderOption);

  options.forEach(optionText => {
    const option = document.createElement('option');
    option.value = optionText.toLowerCase().replace(' ', '-'); // ej: futbol-11
    option.textContent = optionText;
    select.appendChild(option);
  });

  div.appendChild(label);
  div.appendChild(select);
  return div;
}
