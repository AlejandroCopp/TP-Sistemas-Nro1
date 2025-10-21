import { Popup } from './popup/Popup.js';

export class MatchJoinPopupForm extends Popup {
    constructor(matchId, team_name1, team_name2, onSubmit, matchType) {
        let teams = [
            { id: '1', name: 'Equipo ' + team_name1 },
            { id: '2', name: 'Equipo ' + team_name2 }
        ];

        const regex = /^(.*) vs (.*)$/;
        const match = matchType.match(regex);

        if (match && match[1] && match[2]) {
            teams = [
                { id: '1', name: match[1].trim() },
                { id: '2', name: match[2].trim() }
            ];
        }

        const teamOptions = teams.map(team => `<option value="${team.id}">${team.name}</option>`).join('');
        const contentHtml = `
            <form id="match-join-form" class="space-y-4">
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Posición:</label>
                    <input type="text" id="position" name="position" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                </div>
                <div>
                    <label for="team" class="block text-sm font-medium text-gray-700 dark:text-neutral-300">Equipo:</label>
                    <select id="team" name="team" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-neutral-200" required>
                        ${teamOptions}
                    </select>
                </div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Unirse
                </button>
            </form>
        `;
        super('Unirse al Partido', contentHtml);
        this.matchId = matchId;
        this.onSubmit = onSubmit;
    }

    _createModal() {
        super._createModal();
        this.modalElement.querySelector('#match-join-form').addEventListener('submit', async (event) => {
            event.preventDefault();
            const positionInput = this.modalElement.querySelector('#position');
            const teamInput = this.modalElement.querySelector('#team');
            const position = positionInput.value;
            const team = teamInput.value;
            if (position && team) {
                await this.onSubmit(this.matchId, position, team);
                this.close();
            }
        });
    }
}
