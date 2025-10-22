import { UserCard } from './UserCard.js';
import { MatchCardComponent } from './MatchCardComponent.js';
import { NotificationCard } from './NotificationCard.js';
import { PlayerSlotCard } from './PlayerSlotCard.js';
import { PlayerRequestCard } from './PlayerRequestCard.js';

/**
 * Crea y devuelve una tarjeta HTML basada en el tipo de contenido proporcionado.
 * Actúa como un factory, delegando la construcción a funciones específicas.
 * @param {object} contenido - El objeto de datos para la tarjeta.
 * @returns {HTMLElement} El elemento de la tarjeta.
 */
export function CardFactory(contenido) {
  let tarjetaHtml = '';

  switch (contenido.tipo) {
    case 'usuario':
      tarjetaHtml = UserCard(contenido);
      break;
    case 'partido':
      tarjetaHtml = MatchCardComponent(contenido);
      break;
    case 'notificacion':
      tarjetaHtml = NotificationCard(contenido);
      break;
    case 'playerSlot':
      tarjetaHtml = PlayerSlotCard(contenido);
      break;
    case 'playerRequest':
        
        tarjetaHtml = PlayerRequestCard(contenido);
      break;
    default:
      console.error('Tipo de tarjeta no reconocido:', contenido.tipo);
      tarjetaHtml = '<div></div>';
  }

  const tempDiv = document.createElement('div');
  tempDiv.innerHTML = tarjetaHtml.trim();
  return tempDiv.firstChild;
}