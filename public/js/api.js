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
    let mockMatches = []
    try {
        // mockMatches = (await fetch("/api/matches")).json();
        mockMatches = [
            {
                tipo: 'partido',
                id: 1,
                matchType: 'Equipo A vs Equipo B',
                location: 'callecanchita 123, palermo', 
                maxPlayers: 10, // set from frontend
                actualPlayers: 8, // set from frontend
                dateTime: '2025-10-20 18:00:00',
                status: 'Jugando',
                imageUrl: '/public/CanchaImage.png'
            },
            {
                id: 2,
                tipo: 'partido',
                location: 'Av. Libertador 456, nuñez',
                maxPlayers: 10,
                actualPlayers: 4,
                matchType: 'Mixto tranqui',
                dateTime: '2025-10-20 19:30:00',
                status: 'Abierto',
                imageUrl: '/public/CanchaImage.png'
            },
            {
                id: 3,
                tipo: 'partido',
                location: 'Club Femenino, caballito',
                maxPlayers: 10,
                actualPlayers: 9,
                matchType: 'Fútbol 5 Femenino',
                dateTime: '2025-10-21 20:00:00',
                status: 'Abierto',
                imageUrl: '/public/CanchaImage.png'
            },
            {
                id: 4,
                tipo: 'partido',
                location: 'Cancha Central, Belgrano',
                maxPlayers: 11,
                actualPlayers: 10,
                matchType: 'Alquiler de Cancha',
                dateTime: '2025-10-20 21:00:00',
                status: 'Completo',
                imageUrl: '/public/CanchaImage.png'
            },
            {
                id: 5,
                tipo: 'partido',
                location: 'Cancha Municipal',
                maxPlayers: 10,
                actualPlayers: 8,
                matchType: 'Partido de Tarde',
                dateTime: '2025-10-20 18:00:00',
                status: 'Jugando',
                imageUrl: '/public/CanchaImage.png'
            },
            {
                id: 6,
                tipo: 'partido',
                location: 'Club San Martín',
                maxPlayers: 10,
                actualPlayers: 4,
                matchType: 'Busca Jugadores',
                dateTime: '2025-10-21 19:00:00',
                status: 'Buscando jugadores',
                imageUrl: '/public/CanchaImage.png'
            }
        ];
    } catch (error) {
        console.log(error.message)
    }

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


// nombre
// posicion de juego
// equipo a o b

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
