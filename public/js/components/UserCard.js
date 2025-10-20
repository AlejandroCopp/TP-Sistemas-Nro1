/**
 * Crea la tarjeta para la gestión de usuarios (Admin) usando template strings.
 * @param {object} contenido - El objeto de datos para la tarjeta.
 * @returns {string} El HTML de la tarjeta.
 */
export function createUserCard(contenido) {
  const { nombre = '', rol = '', id = '', email = '', estado, imagen, acciones = [] } = contenido;

  const estadoHtml = estado ? `<span class="${estado.color || 'text-gray-500'}">${estado.texto || ''}</span>` : '';
  
  const accionesHtml = acciones.map(accion => `
    <button type="button" class="inline-flex items-center gap-2 px-4 py-2 text-white font-medium rounded-lg shadow-sm focus:outline-none transition ${accion.clase || 'bg-gray-500'}">
      ${accion.texto}
    </button>
  `).join('');

  const imagenHtml = imagen ? `<img src="${imagen}" alt="Imagen descriptiva" class="w-16 h-16 object-cover rounded-lg ml-3">` : '';

  return `
    <div class="flex justify-between items-center border rounded-xl p-3 bg-white shadow-sm mb-3">
      <div class="flex flex-col gap-1">
        <div>
          <strong>${nombre}</strong> ${rol}
        </div>
        <div>
          ${id} • ${email} ${estadoHtml}
        </div>
        ${acciones.length > 0 ? `<div class="flex items-center gap-2 mt-2">${accionesHtml}</div>` : ''}
      </div>
      ${imagenHtml}
    </div>
  `;
}