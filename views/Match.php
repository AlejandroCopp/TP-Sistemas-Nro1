<?php
require_once 'models/UserModel.php';
require_once 'db/Database.php';

function MatchPage($data) {
    $database = new Database();
    $userModel = new UserModel($database->getConnection());
    $match = $data['match'];
    $team_a_players = $data['team_a'];
    $team_b_players = $data['team_b'];
    $team_size = $match['max_players'] / 2;
    
    // Prepare match data for JS
    $timestamp = is_numeric($match['datetime_scheduled']) ? $match['datetime_scheduled'] : strtotime($match['datetime_scheduled']);
    $user_id = $userModel->getUserByEmail($_SESSION["email"],"id");
    
    $match_for_js = [
        'id' => $match['id'],
        'team_name1' => $match['team_name1'],
        'team_name2' => $match['team_name2'],
        'matchType' => $match['name'],
        'location' => $match['location'],
        'scheduled' => $timestamp, // Pass the raw timestamp
        'maxPlayers' => $match['max_players'],
        'actualPlayers' => count($team_a_players) + count($team_b_players),
        'imageUrl' => $match['image_url']
    ];
    
    // Prepare team A data for JS
    $team_a_for_js = [];
    foreach ($team_a_players as $player) {
        $team_a_for_js[] = ['tipo' => 'playerSlot', 'nombre' => $player['name']];
    }
    for ($i = count($team_a_players); $i < $team_size; $i++) {
        $team_a_for_js[] = ['tipo' => 'playerSlot']; // Empty slot
    }
    
    // Prepare team B data for JS
    $team_b_for_js = [];
    foreach ($team_b_players as $player) {
        $team_b_for_js[] = ['tipo' => 'playerSlot', 'nombre' => $player['name']];
    }
    for ($i = count($team_b_players); $i < $team_size; $i++) {
        $team_b_for_js[] = ['tipo' => 'playerSlot']; // Empty slot
    }
    $is_manager = isset($user_id) && $match['manager_id'] == $user_id["id"];
    $join_button_text = $is_manager ? 'Ver Postulaciones' : 'Unirse al Partido';
    
    ob_start(); // Start output buffering

?>

<div class="max-w-sm mx-auto bg-white dark:bg-neutral-900 rounded-b-3xl shadow-lg font-sans">
    
    <!-- The Match Info will be rendered here by JavaScript -->
    <div id="match-info-container"></div>

    <!-- Action Buttons -->
    <div class="p-4 border-t border-b border-gray-200 dark:border-neutral-700">
        <div class="grid grid-cols-2 gap-4">
            <button id="join-match-btn" class="w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700">
                <?php echo $join_button_text; ?>
            </button>
            <button id="share-match-btn" type="button" class="w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700">
                Compartir
            </button>
        </div>
    </div>

    <!-- Teams -->
    <div class="p-4">
        <h2 class="text-center text-xl font-bold mb-4 text-gray-800 dark:text-neutral-200"><?php echo htmlspecialchars($match['name']); ?></h2>
        <div class="grid grid-cols-2 gap-4">
            
            <!-- Team A -->
            <div id="team-a-container"></div>

            <!-- Team B -->
            <div id="team-b-container"></div>
        </div>
    </div>
</div>

<script type="module">
    import { MatchCardComponent } from '/public/js/components/MatchCardComponent.js';
    import { CardList } from '/public/js/components/CardList.js';
    import { SharePopup } from '/public/js/components/SharePopup.js';
    import { AlertPopup } from '/public/js/components/popup/AlertPopup.js';
    import { MatchJoinPopupForm } from '/public/js/components/MatchJoinPopupForm.js';

    const matchData = <?php echo json_encode($match_for_js); ?>;
    
    const matchInfoContainer = document.getElementById('match-info-container');
    if (matchInfoContainer) {
        matchInfoContainer.innerHTML = MatchCardComponent(matchData);
    }
    CardList(<?php echo json_encode($team_a_for_js); ?>, '#team-a-container');
    CardList(<?php echo json_encode($team_b_for_js); ?>, '#team-b-container');

    // --- Share Popup Logic ---
    const shareBtn = document.getElementById('share-match-btn');
    if (shareBtn) {
        shareBtn.addEventListener('click', () => {
            const shareModal = new SharePopup(matchData.id);
            shareModal.open();
        });
    }

    // --- Join Match Logic ---
    const joinBtn = document.getElementById('join-match-btn');
    // Check if the button text is 'Unirse al Partido' (not 'Ver Postulaciones')
    if (joinBtn && joinBtn.textContent.trim() === 'Unirse al Partido') {
        joinBtn.addEventListener('click', async () => {
            const handleJoinMatch = async (matchId, position, team) => {
                const formData = new FormData();
                formData.append('matchId', matchId);
                formData.append('position', position);
                formData.append('team', team);

                try {
                    const response = await fetch('/api/match/request', {
                        method: 'POST',
                        body: new URLSearchParams(formData)
                    });

                    const result = await response.json();

                    if (!response.ok || !result.success) {
                        throw new Error(result.message || 'No se pudo enviar la solicitud.');
                    }

                    window.location.href = '/waitlist/';

                } catch (error) {
                    const alert = new AlertPopup(error.message);
                    alert.open();
                }
            };
            const joinFormPopup = new MatchJoinPopupForm(matchData.id, matchData.team_name1, matchData.team_name2, handleJoinMatch, matchData.matchType);
            joinFormPopup.open();
        });
    }
</script>
<?php } ?>