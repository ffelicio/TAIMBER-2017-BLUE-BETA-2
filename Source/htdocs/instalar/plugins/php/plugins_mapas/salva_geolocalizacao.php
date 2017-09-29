<?php

// salva a geolocalizacao na memoria
function salva_geolocalizacao(){

// atualizando sessao
$_SESSION[SESSAO_MAPA_BING]["latitude"] = retorne_campo_formulario_request(56);
$_SESSION[SESSAO_MAPA_BING]["longitude"] = retorne_campo_formulario_request(57);

};

?>