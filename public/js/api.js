/**
 * @file api.js
 * @description This module handles all communication with the backend API.
 * For now, it uses mock data, but it's designed to be easily updated
 * to make real fetch requests.
 */

import { sanitize } from './utils.js'; // Import sanitize for filtering mock data

/**
 * Fetches the list of matches from the API.
 * TODO: Replace this with a real `fetch` call to the backend endpoint when it's ready.
 * @param {string} [searchTerm=''] - Optional search term to filter matches.
 * @returns {Promise<Array<object>>} A promise that resolves to an array of match objects.
 */
export async function fetchMatches(searchTerm = '') {
    console.log(`Fetching matches with search term: "${searchTerm}" (mock data)`);
    // Simulate a network delay
    await new Promise(resolve => setTimeout(resolve, 500));

    // Mock data
    // const mockMatches = []
    const mockMatches = [
        {
            matchId:"1", // cambiar por "id"
            tipo: 'partido',
            category: 'jugadores', // borrar
            location: 'callecanchita 123, palermo', 
            maxPlayers: 10,
            actualPlayers: 8,
            title: 'Equipo A vs Equipo B', // renombrar como "name"
            matchType: '5 vs 5',
            dateTime: 'Hoy 18:00 hs',
            status: 'jugando',
            imageUrl: 'public/CanchaImage.png'
        },
        {
            matchId:"2",
            tipo: 'partido',
            category: 'jugadores',
            location: 'Av. Libertador 456, nuñez',
            playerCount: '4/10',
            title: 'Mixto tranqui',
            matchType: '5 vs 5',
            dateTime: 'Hoy 19:30 hs',
            status: 'abierto',
            imageUrl: 'public/CanchaImage.png'
        },
        {
            matchId:"3",
            tipo: 'partido',
            category: 'jugadoras',
            location: 'Club Femenino, caballito',
            playerCount: '9/10',
            title: 'Fútbol 5 Femenino',
            matchType: '5 vs 5',
            dateTime: 'Mañana 20:00 hs',
            status: 'abierto',
            imageUrl: 'public/CanchaImage.png'
        },
        {
            matchId:"4",
            tipo: 'partido',
            category: 'canchas',
            location: 'Cancha Central, Belgrano',
            playerCount: '10/10',
            title: 'Alquiler de Cancha',
            matchType: 'Fútbol 11',
            dateTime: 'Hoy 21:00 hs',
            status: 'completo',
            imageUrl: 'public/CanchaImage.png'
        },
        {
            matchId: "5",
            tipo: 'partido',
            category: 'jugadores',
            location: 'Cancha Municipal',
            playerCount: '8/10',
            title: 'Partido de Tarde',
            matchType: '5 vs 5',
            dateTime: 'Hoy 18:00 hs',
            status: 'Jugando',
            imageUrl: 'public/CanchaImage.png'
        },
        {
            matchId: "6",
            tipo: 'partido',
            category: 'jugadores',
            location: 'Club San Martín',
            playerCount: '4/10',
            title: 'Busca Jugadores',
            matchType: '5 vs 5',
            dateTime: 'Mañana 19:00 hs',
            status: 'Buscando jugadores',
            imageUrl: 'public/CanchaImage.png+Imagen'
        }
    ];

    if (searchTerm) {
        const sanitizedSearchTerm = sanitize(searchTerm).toLowerCase();
        return mockMatches.filter(match => {
            return Object.values(match).some(value =>
                String(value).toLowerCase().includes(sanitizedSearchTerm)
            );
        });
    }

    return mockMatches;
}

/**
 * Fetches the list of users from the API.
 * @returns {Promise<Array<object>>} A promise that resolves to an array of user objects.
 */
export async function fetchUsers() {
    console.log(`Fetching users (mock data)`);
    await new Promise(resolve => setTimeout(resolve, 500));
    const mockUsers = [
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
      }
    ];
    return mockUsers;
}

/**
 * Fetches the list of notifications from the API.
 * @returns {Promise<Array<object>>} A promise that resolves to an array of notification objects.
 */
export async function fetchNotifications() {
    console.log(`Fetching notifications (mock data)`);
    await new Promise(resolve => setTimeout(resolve, 500));
    const mockNotifications = [
      {
        tipo: 'notificacion',
        mensaje: '¡Tu partido en "Club San Martín" está por comenzar!',
        hora: 'Hace 3 minutos',
        icono: 'fa fa-bell'
      }
    ];
    return mockNotifications;
}
