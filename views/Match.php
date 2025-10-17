<?php

function MatchPage($match_id) {
    // En una aplicación real, aquí buscarías los datos del partido en la base de datos usando $match_id.
    // Para este ejemplo, usaremos datos de muestra que coinciden con la imagen.
    $sample_match_data = [
        'location' => 'calle canchita 123, palermo',
        'date' => 'Hoy',
        'time' => '18:00 hs',
        'matchType' => '5 vs 5',
        'isPlaying' => true,
        'mode' => 'user', // o 'admin'
    ];
?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detalles del Partido #<?php echo htmlspecialchars($match_id); ?></h1>

    <div id="match-card-container"></div>
</div>

<script src="/public/js/MatchCard.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const matchData = <?php echo json_encode($sample_match_data); ?>;
        const container = document.getElementById('match-card-container');
        MatchCard(matchData, container);
    });
</script>
<?php
}
?>