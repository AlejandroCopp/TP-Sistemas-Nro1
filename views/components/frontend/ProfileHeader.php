<?php

/**
 * Generates an HTML profile header component.
 *
 * @param array $props An associative array containing the properties for the header.
 *                      - logoUrl (string): The URL for the logo image.
 *                      - title (string): The main title.
 *                      - box1_title (string): The title for the first statistics box.
 *                      - box1_value (int): The current value for the first statistics box.
 *                      - box1_max (int): The maximum value for the first statistics box.
 *                      - box2_title (string): The title for the second statistics box.
 *                      - box2_value (int): The current value for the second statistics box.
 *                      - box2_max (int): The maximum value for the second statistics box.
 * @return string The HTML markup for the profile header.
 */
function ProfileHeader($props) {
    $logoUrl = htmlspecialchars($props['logoUrl'] ?? 'https://via.placeholder.com/150');
    $title = htmlspecialchars($props['title'] ?? 'Nombre de la App');
    $box1_title = htmlspecialchars($props['box1_title'] ?? 'Canchitas Afil. Activas');
    $box1_value = htmlspecialchars($props['box1_value'] ?? 23);
    $box1_max = htmlspecialchars($props['box1_max'] ?? 30);
    $box2_title = htmlspecialchars($props['box2_title'] ?? 'Jugadores Activos');
    $box2_value = htmlspecialchars($props['box2_value'] ?? 230);
    $box2_max = htmlspecialchars($props['box2_max'] ?? 300);

    return <<<HTML
    <div class="p-4 bg-white rounded-lg shadow-md flex items-center space-x-6">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <img class="w-24 h-24 rounded-full border-4 border-gray-200" src="{$logoUrl}" alt="Logo">
        </div>

        <!-- Title and Stats -->
        <div class="flex flex-col space-y-2">
            <h2 class="text-2xl font-bold text-gray-800">{$title}</h2>
            <div class="flex space-x-4">
                <!-- Stat Box 1 -->
                <div class="p-3 border border-gray-300 rounded-lg text-center w-48">
                    <p class="text-sm text-gray-600">{$box1_title}</p>
                    <p class="text-2xl font-bold text-gray-800">{$box1_value}/{$box1_max}</p>
                </div>
                <!-- Stat Box 2 -->
                <div class="p-3 border border-gray-300 rounded-lg text-center w-48">
                    <p class="text-sm text-gray-600">{$box2_title}</p>
                    <p class="text-2xl font-bold text-gray-800">{$box2_value}/{$box2_max}</p>
                </div>
            </div>
        </div>
    </div>
HTML;
}

?>
