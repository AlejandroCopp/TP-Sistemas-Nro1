/**
 * Creates a player card or an empty slot for the match view.
 * @param {object} contenido - The content for the card. If it's a player, it should have a 'name' property.
 * @returns {string} The HTML of the card.
 */
export function PlayerSlotCard(contenido) {
  console.log('$$$$$$$$$$$$$$$$', contenido)
  // If there's a name, it's a player. Otherwise, it's an empty slot.
  if (contenido && contenido.nombre) {
    const { nombre, imagen = '/public/UsuarioImage.png', position } = contenido;
    return `
      <div class="flex items-center justify-between border border-gray-200 dark:border-neutral-700 rounded-lg p-2 h-16">
          <div>
              <p class="font-bold text-gray-800 dark:text-neutral-200">${nombre}</p>
              <p class="font-bold text-gray-600 dark:text-neutral-200 h-12">${position}</p>
          </div>
          <div class="w-10 h-10 bg-gray-300 dark:bg-neutral-600 rounded-full bg-cover bg-center" style="background-image: url('${imagen}')"></div>
      </div>
    `;
  }

  // Render an empty slot
  return `
    <div class="border-2 border-dashed border-gray-300 dark:border-neutral-600 rounded-lg p-2 h-16"></div>
  `;
}
