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
    const mockMatches = [
        {
            matchId:"1",
            category: 'jugadores',
            location: 'callecanchita 123, palermo',
            playerCount: '8/10',
            title: 'Equipo A vs Equipo B',
            matchType: '5 vs 5',
            dateTime: 'Hoy 18:00 hs',
            status: 'jugando',
            imageUrl: 'https://via.placeholder.com/150/28a745/ffffff?text=Cancha'
        },
        {
            matchId:"2",
            category: 'jugadores',
            location: 'Av. Libertador 456, nuñez',
            playerCount: '4/10',
            title: 'Mixto tranqui',
            matchType: '5 vs 5',
            dateTime: 'Hoy 19:30 hs',
            status: 'abierto',
            imageUrl: 'https://via.placeholder.com/150/007bff/ffffff?text=Cancha'
        },
        {
            matchId:"3",
            category: 'jugadoras',
            location: 'Club Femenino, caballito',
            playerCount: '9/10',
            title: 'Fútbol 5 Femenino',
            matchType: '5 vs 5',
            dateTime: 'Mañana 20:00 hs',
            status: 'abierto',
            imageUrl: 'https://via.placeholder.com/150/dc3545/ffffff?text=Cancha'
        },
        {
            matchId:"4",
            category: 'canchas',
            location: 'Cancha Central, Belgrano',
            playerCount: '10/10',
            title: 'Alquiler de Cancha',
            matchType: 'Fútbol 11',
            dateTime: 'Hoy 21:00 hs',
            status: 'completo',
            imageUrl: 'https://via.placeholder.com/150/ffc107/ffffff?text=Cancha'
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