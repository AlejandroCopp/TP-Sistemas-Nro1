// --- Contenido de CrearTarjeta.js ---

// --- Card Factory (111.js) ---

/**
 * Crea y devuelve una tarjeta HTML basada en el tipo de contenido proporcionado.
 * Actúa como un factory, delegando la construcción a funciones específicas.
 * @param {object} contenido - El objeto de datos para la tarjeta.
 * @returns {HTMLElement} El elemento de la tarjeta.
 */
function crearTarjeta(contenido) {
  switch (contenido.tipo) {
    case 'usuario':
      return _crearTarjetaUsuario(contenido);
    case 'partido':
      return _crearTarjetaPartido(contenido);
    case 'notificacion':
      return _crearTarjetaNotificacion(contenido);
    default:
      console.error('Tipo de tarjeta no reconocido:', contenido.tipo);
      return document.createElement('div'); // Devuelve un div vacío como fallback
  }
}

/**
 * Crea la tarjeta para la gestión de usuarios (Admin).
 * @private
 */
function _crearTarjetaUsuario(contenido) {
  const tarjeta = _crearContenedorBase();
  const textoContainer = _crearTextoContainer();

  // Fila 1: Nombre y Rol
  const fila1 = document.createElement('div');
  const nombre = document.createElement('strong');
  nombre.textContent = contenido.nombre || '';
  fila1.appendChild(nombre);
  const rol = document.createTextNode(` ${contenido.rol || ''}`);
  fila1.appendChild(rol);
  textoContainer.appendChild(fila1);

  // Fila 2: ID, Email y Estado
  const fila2 = document.createElement('div');
  fila2.textContent = `${contenido.id || ''} • ${contenido.email || ''} `;
  if (contenido.estado) {
    const estadoSpan = _crearEstadoSpan(contenido.estado);
    fila2.appendChild(estadoSpan);
  }
  textoContainer.appendChild(fila2);

  // Fila 3: Botones de Acción
  if (contenido.acciones && contenido.acciones.length > 0) {
    const fila3 = document.createElement('div');
    fila3.className = 'flex items-center gap-2 mt-2';
    contenido.acciones.forEach(accion => {
      const button = document.createElement('button');
      button.type = 'button';
      button.textContent = accion.texto;
      button.className = `inline-flex items-center gap-2 px-4 py-2 text-white font-medium rounded-lg shadow-sm focus:outline-none transition ${accion.clase || 'bg-gray-500'}`;
      fila3.appendChild(button);
    });
    textoContainer.appendChild(fila3);
  }
  
  tarjeta.appendChild(textoContainer);

  if (contenido.imagen) {
    tarjeta.appendChild(_crearImagen(contenido.imagen));
  }

  return tarjeta;
}

/**
 * Crea la tarjeta para el listado de partidos.
 * @private
 */
function _crearTarjetaPartido(contenido) {
  const tarjeta = _crearContenedorBase();
  const textoContainer = _crearTextoContainer();

  // Fila 1: Jugadores
  if (contenido.jugadores) {
    const fila1 = document.createElement('div');
    const strong = document.createElement('strong');
    strong.textContent = `${contenido.jugadores.actual || 0}/${contenido.jugadores.total || 0}`;
    fila1.appendChild(strong);
    const texto = document.createTextNode(' jugadores');
    fila1.appendChild(texto);
    textoContainer.appendChild(fila1);
  }

  // Fila 2: Detalle y Estado
  const fila2 = document.createElement('div');
  fila2.textContent = `${contenido.detalle || ''} `;
  if (contenido.estado) {
    fila2.appendChild(_crearEstadoSpan(contenido.estado));
  }
  textoContainer.appendChild(fila2);

  // Fila 3: Lugar
  if (contenido.lugar) {
    const fila3 = document.createElement('div');
    fila3.textContent = contenido.lugar;
    textoContainer.appendChild(fila3);
  }

  tarjeta.appendChild(textoContainer);

  if (contenido.imagen) {
    tarjeta.appendChild(_crearImagen(contenido.imagen));
  }

  return tarjeta;
}

/**
 * Crea la tarjeta para notificaciones.
 * @private
 */
function _crearTarjetaNotificacion(contenido) {
  // Las notificaciones pueden tener un layout ligeramente diferente
  const tarjeta = _crearContenedorBase('items-start'); // Alinea al inicio
  const textoContainer = _crearTextoContainer();

  if (contenido.mensaje) {
    const mensaje = document.createElement('div');
    mensaje.textContent = contenido.mensaje;
    textoContainer.appendChild(mensaje);
  }

  if (contenido.hora) {
    const hora = document.createElement('div');
    hora.className = 'text-sm text-gray-500 mt-1';
    hora.textContent = contenido.hora;
    textoContainer.appendChild(hora);
  }
  
  tarjeta.appendChild(textoContainer);
  
  // Opcional: Ícono en lugar de imagen
  if (contenido.icono) {
      const iconoEl = document.createElement('i'); // Asumiendo una librería de íconos como FontAwesome
      iconoEl.className = `${contenido.icono} text-gray-400 text-xl ml-3`;
      tarjeta.appendChild(iconoEl);
  }

  return tarjeta;
}


// --- Funciones Auxiliares ---

function _crearContenedorBase(extraClasses = 'items-center') {
  const tarjeta = document.createElement('div');
  tarjeta.className = `flex justify-between ${extraClasses} border rounded-xl p-3 bg-white shadow-sm mb-3`;
  return tarjeta;
}

function _crearTextoContainer() {
  const textoContainer = document.createElement('div');
  textoContainer.className = 'flex flex-col gap-1';
  return textoContainer;
}

function _crearImagen(src) {
  const imagen = document.createElement('img');
  imagen.src = src;
  imagen.alt = 'Imagen descriptiva';
  imagen.className = 'w-16 h-16 object-cover rounded-lg ml-3';
  return imagen;
}

function _crearEstadoSpan(estado) {
  const estadoSpan = document.createElement('span');
  estadoSpan.textContent = estado.texto || '';
  estadoSpan.className = estado.color || 'text-gray-500';
  return estadoSpan;
}


// --- Contenido de NewMatch.js ---

/**
 * Crea y devuelve un formulario HTML para la creación de un nuevo partido.
 * @param {function} onVolver - Callback que se ejecuta al presionar el botón "Volver".
 * @returns {HTMLFormElement} El elemento del formulario.
 */
function crearFormularioPartido(onVolver) {
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


// --- Contenido original de index2.js ---

document.addEventListener('DOMContentLoaded', () => {
    const datosDePrueba = [
      // --- Variante de Tarjeta de Partido ---
      {
        tipo: 'partido',
        jugadores: { actual: 8, total: 10 },
        detalle: '5 vs 5 • Hoy 18:00 hs',
        estado: { texto: 'Jugando', color: 'text-green-600' },
        lugar: 'Cancha Municipal',
        imagen: 'public/CanchaImage.png'
      },
      // --- Variante de Tarjeta de Usuario (Admin) ---
      {
        tipo: 'usuario',
        nombre: 'Pepito',
        rol: 'Delantero',
        id: '#48642',
        email: 'pepito@gmail.com',
        estado: { texto: 'Activo', color: 'text-green-600' },
        imagen: 'public/UsuarioImage.png',
        acciones: [
            { texto: 'Editar', clase: 'bg-blue-600 hover:bg-blue-700' },
            { texto: 'Eliminar', clase: 'bg-red-600 hover:bg-red-700' }
        ]
      },
      // --- Variante de Tarjeta de Notificación ---
      {
        tipo: 'notificacion',
        mensaje: '¡Tu partido en "Club San Martín" está por comenzar!',
        hora: 'Hace 3 minutos',
        icono: 'fa fa-bell' // Ejemplo con FontAwesome, si lo usaras
      },
      {
        tipo: 'partido',
        jugadores: { actual: 4, total: 10 },
        detalle: '5 vs 5 • Mañana 19:00 hs',
        estado: { texto: 'Buscando jugadores', color: 'text-yellow-500' },
        lugar: 'Club San Martín'
        // Sin imagen
      }
    ];

    const mainContainer = document.getElementById('contenedor-partidos');

    function mostrarPartidos() {
        mainContainer.innerHTML = '';

        const headerContainer = document.createElement('div');
        headerContainer.className = 'flex justify-between items-center mb-4';

        const title = document.createElement('h1');
        title.textContent = 'Partidos Disponibles';
        title.className = 'text-2xl font-bold';

        const crearPartidoBtn = document.createElement('button');
        crearPartidoBtn.textContent = 'Crear Nuevo Partido';
        crearPartidoBtn.className = 'inline-flex items-center justify-center px-4 py-2 text-white font-medium rounded-lg shadow-sm bg-blue-600 hover:bg-blue-700 focus:outline-none transition';
        crearPartidoBtn.addEventListener('click', mostrarFormularioCrearPartido);
        
        headerContainer.appendChild(title);
        headerContainer.appendChild(crearPartidoBtn);
        mainContainer.appendChild(headerContainer);

        if (typeof crearTarjeta === 'function') {
            datosDePrueba.forEach(dato => {
                const tarjeta = crearTarjeta(dato);
                mainContainer.appendChild(tarjeta);
            });
        } else {
            mainContainer.innerHTML += '<p>Error: La función crearTarjeta no está definida.</p>';
        }
    }

    function mostrarFormularioCrearPartido() {
        mainContainer.innerHTML = '';
        if (typeof crearFormularioPartido === 'function') {
            const form = crearFormularioPartido(mostrarPartidos);
            mainContainer.appendChild(form);
        } else {
            // Este bloque ahora es menos probable que se ejecute
            mainContainer.innerHTML = '<p>Error: La función crearFormularioPartido no está definida.</p><button id="backBtn">Volver</button>';
            document.getElementById('backBtn').addEventListener('click', mostrarPartidos);
        }
    }

    if (mainContainer) {
        mostrarPartidos();
    } else {
        console.error('El contenedor principal "contenedor-partidos" no fue encontrado.');
    }
});
