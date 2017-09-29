<?php

// converte url para video de youtube
function converte_url_video_youtube($conteudo){

// altura de player
$altura_player = ALTURA_PLAYER_YOUTUBE."px";

// converte url em video de youtube
$conteudo = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<iframe width=\"100%\" height=\"$altura_player\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>", $conteudo);

// retorno
return $conteudo;

};

?>