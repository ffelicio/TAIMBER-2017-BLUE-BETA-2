<?php

// recurso medias
function recurso_medias(){

// globals
global $pasta_host_sistema;

// pasta de recurso
$pasta_recurso = $pasta_host_sistema["pasta_recursos_sistema"]."player_media/";

// url de scripts
$script[0] = $pasta_recurso."mediaelementplayer.css";
$script[1] = $pasta_recurso."mediaelement-and-player.min.js";

// campo script
$campo_script = "

<script>
$(function(){
    $('audio,video').mediaelementplayer({
        loop: false,
        audioHeight: 30,
    });
});
</script>

";

// html
$html = "
\n
<link rel='stylesheet' href='$script[0]' type='text/css'>
\n
<script type='text/javascript' src='$script[1]'></script>
\n
$campo_script
\n
";

// retorno
return $html;

};

?>