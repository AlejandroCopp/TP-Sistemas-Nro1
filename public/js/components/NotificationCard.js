/**
 * Crea la tarjeta para notificaciones usando template strings.
 * @param {object} contenido - El objeto de datos para la tarjeta.
 * @returns {string} El HTML de la tarjeta.
 */
export function NotificationCard(contenido) {
  const { mensaje = '', hora = '', icono = '' } = contenido;

  const iconoHtml = icono ? `<i class="${icono} text-gray-400 text-xl ml-3"></i>` : '';

  return `
    <div class="flex justify-between items-start border rounded-xl p-3 bg-white shadow-sm mb-3">
      <div class="flex flex-col gap-1">
        <div>${mensaje}</div>
        ${hora ? `<div class="text-sm text-gray-500 mt-1">${hora}</div>` : ''}
      </div>
      ${iconoHtml}
    </div>
  `;
}