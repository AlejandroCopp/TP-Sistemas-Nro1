<?php

function Waitlist($data){
    $pendingPlayers = $data['pendingPlayers'];
    $matchId = $data['matchId'];


?>
<h1>Waitlist</h1>
<div id="pending-players-container"></div>

<script type="module">
    import { CardList } from "/public/js/components/CardList.js";

    const pendingPlayers = <?php echo json_encode($pendingPlayers); ?>;
    const matchId = <?php echo json_encode($matchId); ?>;
    const matchType = <?php echo json_encode($data['matchType']); ?>;

    async function handleRequest(playerId, action) {
        const formData = new FormData();
        formData.append('matchId', matchId);
        formData.append('playerId', playerId);

        try {
            const response = await fetch(`/api/match/request/${action}`, {
                method: 'POST',
                body: new URLSearchParams(formData)
            });
            const result = await response.json();

            if (result.success) {
                alert(`Solicitud ${action === 'accept' ? 'aceptada' : 'rechazada'} con éxito.`);
                // Reload the page or update the list
                window.location.reload();
            } else {
                alert(`Error al ${action === 'accept' ? 'aceptar' : 'rechazar'} la solicitud: ${result.message}`);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Ocurrió un error al procesar la solicitud.');
        }
    }

    // Map pendingPlayers to include the 'tipo' for CardFactory and necessary data for PlayerRequestCard
    const playersToRender = pendingPlayers.map(player => ({
        ...player,
        tipo: 'playerRequest',
        matchId: matchId,
        matchType: matchType,
        onAccept: (playerId) => handleRequest(playerId, 'accept'),
        onDecline: (playerId) => handleRequest(playerId, 'decline'),
    }));

    CardList(playersToRender, '#pending-players-container');

    // Add event listeners for the dynamically created buttons
    document.addEventListener('click', async (event) => {
        if (event.target.classList.contains('accept-btn')) {
            const playerId = event.target.dataset.playerId;
            await handleRequest(playerId, 'accept');
        } else if (event.target.classList.contains('decline-btn')) {
            const playerId = event.target.dataset.playerId;
            await handleRequest(playerId, 'decline');
        }
    });
</script>
<?php }?>