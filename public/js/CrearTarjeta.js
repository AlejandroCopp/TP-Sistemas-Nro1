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