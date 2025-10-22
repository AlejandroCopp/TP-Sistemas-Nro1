import { PlayerSlotCard } from './PlayerSlotCard.js';

export function PlayerRequestCard(player, matchType) {
    const { id: playerId, name, position, team } = player;

    /*
    let teamName = `Equipo ${team}`;
    const regex = /^(.*) vs (.*)$/;
    const match = matchType.match(regex);

    if (match && match[1] && match[2]) {
        if (team === 1) {
            teamName = match[1].trim();
        } else if (team === 2) {
            teamName = match[2].trim();
        }
    }
        */

    return `
        <div class="flex items-center justify-between border border-gray-200 dark:border-neutral-700 rounded-lg p-2 h-auto">
            <div class="flex-grow">
                <p class="font-bold text-gray-800 dark:text-neutral-200">${name} (${position})</p>
                <p class="text-sm text-gray-600 dark:text-neutral-400">Equipo: ${team}</p>
            </div>
            <div class="flex space-x-2 ml-4">
                <button class="accept-btn bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-1 px-3 rounded-lg" data-player-id="${playerId}" data-match-id="${player.matchId}">
                    Aceptar
                </button>
                <button class="decline-btn bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-1 px-3 rounded-lg" data-player-id="${playerId}" data-match-id="${player.matchId}">
                    Rechazar
                </button>
            </div>
        </div>
    `;
}
