import { createUserCard } from './UserCard.js';
import { createMatchCard } from './MatchCardComponent.js';
import { createNotificationCard } from './NotificationCard.js';

/**
 * Crea y devuelve una tarjeta HTML basada en el tipo de contenido proporcionado.
 * Actúa como un factory, delegando la construcción a funciones específicas.
 * @param {object} contenido - El objeto de datos para la tarjeta.
 * @returns {HTMLElement} El elemento de la tarjeta.
 */
export function cardFactory(contenido) {
  let tarjetaHtml = '';

  switch (contenido.tipo) {
    case 'usuario':
      tarjetaHtml = createUserCard(contenido);
      break;
    case 'partido':
      tarjetaHtml = createMatchCard(contenido);
      break;
    case 'notificacion':
      tarjetaHtml = createNotificationCard(contenido);
      break;
    default:
      console.error('Tipo de tarjeta no reconocido:', contenido.tipo);
      tarjetaHtml = '<div></div>';
  }

  const tempDiv = document.createElement('div');
  tempDiv.innerHTML = tarjetaHtml.trim();
  return tempDiv.firstChild;
}