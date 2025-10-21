<?php

// Helper function to render a player card
function renderPlayerCard($player) {

    $name = htmlspecialchars($player['name']);
    ?>
    <div class="flex items-center justify-between border border-gray-200 dark:border-neutral-700 rounded-lg p-2 mb-2 h-16">
        <div>
            <p class="font-bold text-gray-800 dark:text-neutral-200"><?php echo $name;?></p>
        </div>
        <div class="w-10 h-10 bg-gray-300 dark:bg-neutral-600 rounded-full bg-cover bg-center" style="background-image: url('/public/UsuarioImage.png')"></div>
    </div>
    <?php;
}

// Helper function to render an empty player slot
function renderEmptySlot() {
    echo '<div class="border-2 border-dashed border-gray-300 dark:border-neutral-600 rounded-lg p-2 mb-2 h-16"></div>';
}

function MatchPage($data) {
    $match = $data['match'];
    $team_a = $data['team_a'];
    $team_b = $data['team_b'];
    $team_size = $match['max_players'] / 2;

    // Prepare the match data array with the keys expected by the JavaScript component.
    $match_for_js = [
        'id' => $match['id'],
        'matchType' => $match['name'],
        'location' => $match['location'],
        'dateTime' => $match['datetime_scheduled'],
        'maxPlayers' => $match['max_players'],
        'actualPlayers' => $match['actualPlayers'],
        'status' => $match['status'],
        'imageUrl' => $match['image_url']
    ];

    ob_start(); // Start output buffering
?>

<div class="max-w-sm mx-auto bg-white dark:bg-neutral-900 rounded-b-3xl shadow-lg font-sans">
    
    <!-- The Match Info will be rendered here by JavaScript -->
    <div id="match-info-container"></div>

    <!-- Teams -->
    <div class="p-4">
        <h2 class="text-center text-xl font-bold mb-4 text-gray-800 dark:text-neutral-200"><?php echo htmlspecialchars($match['name']); ?></h2>
        <div class="grid grid-cols-2 gap-4">
            
            <!-- Team A -->
            <div>
                <?php
                foreach ($team_a as $player) {
                    renderPlayerCard($player);
                }
                for ($i = count($team_a); $i < $team_size; $i++) {
                    renderEmptySlot();
                }
                ?>
            </div>

            <!-- Team B -->
            <div>
                <?php
                foreach ($team_b as $player) {
                    renderPlayerCard($player);
                }
                for ($i = count($team_b); $i < $team_size; $i++) {
                    renderEmptySlot();
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script type="module">
    import { createMatchCard } from '/public/js/components/MatchCardComponent.js';

    // Get the data prepared by PHP
    const matchData = <?php echo json_encode($match_for_js); ?>;
    
    // Get the container
    const container = document.getElementById('match-info-container');

    if (container) {
        // Create the card HTML and inject it
        const matchCardHTML = createMatchCard(matchData);
        container.innerHTML = matchCardHTML;
    }
</script>

<?php
    return ob_get_clean(); // Return the buffered content
}
?>