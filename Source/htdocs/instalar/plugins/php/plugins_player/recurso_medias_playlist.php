<?php

// recurso medias com suporte a playlist
function recurso_medias_playlist(){

// globals
global $pasta_host_sistema;

// pasta de recurso
$pasta_recurso = $pasta_host_sistema["pasta_recursos_sistema"]."player_media/";

// url de scripts
$script[0] = $pasta_recurso."mediaelementplayer.css";
$script[1] = $pasta_recurso."mediaelement-and-player.min.js";
$script[2] = $pasta_recurso."mep-feature-playlist.js";
$script[3] = $pasta_recurso."mep-feature-playlist.css";

// campo script
$campo_script = "

<script>
$(function(){
    $('audio,video').mediaelementplayer({
        loop: false,
        shuffle: true,
        playlist: true,
        audioHeight: 30,
        playlistposition: 'bottom',
        features: ['playlistfeature', 'prevtrack', 'playpause', 'nexttrack', 'loop', 'shuffle', 'playlist', 'current', 'progress', 'duration', 'volume', 'fullscreen'],
    });
});
</script>

";

// html
$html = "
\n
<link rel='stylesheet' href='$script[0]' type='text/css' media='screen'/>
\n
<script type='text/javascript' src='$script[1]'></script>
\n
<script type='text/javascript' src='$script[2]'></script>
\n
<link rel='stylesheet' href='$script[3]' type='text/css' media='screen'/>
\n
\n
$campo_script
\n
";

// retorno
return $html;

};

?>