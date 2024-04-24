<?php
$url = "https://rickandmortyapi.com/api/character/";
$response = file_get_contents($url);
$data = json_decode($response, true);

$episodeCache = array();

foreach ($data['results'] as $character) {
    echo "<div class='character-block'>";
    echo "<div class='character-container'>";
    echo "<img src='{$character['image']}' alt='{$character['name']}'>";
    echo "<div class='character-details'>";
    echo "<h2>{$character["name"]}</h2>";



    echo "<p>Episodes:</p>";
    echo "<div class='episodes-container'>";
    echo "<ul class='episodes'>";
    foreach ($character['episode'] as $episodeUrl) {
        if (!isset($episodeCache[$episodeUrl])) {
            $episodeResponse = file_get_contents($episodeUrl);
            $episodeCache[$episodeUrl] = json_decode($episodeResponse, true);
        }
        $episodeData = $episodeCache[$episodeUrl];
        echo "<li><a href='" . $episodeUrl . "'>" . $episodeData['name'] . "</a></li>";
    }
    echo "</ul>";
    echo "</div>"; // 'episodes'
    echo "</div>"; // 'character-details'
    echo "</div>"; // 'episodes-container'
    echo "</div>"; // 'character-block'
}
?>