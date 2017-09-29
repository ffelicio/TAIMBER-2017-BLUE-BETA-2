<?php

// atualiza o numero de amigos online
function atualiza_numero_amigos_online(){

// globals
global $idioma_sistema;

// numero de amigos online
$numero_online = retorne_tamanho_resultado(retorna_numero_amigos_online(retorne_idusuario_request()));

// array de retorno
$array_retorno["dados"] = $idioma_sistema[386].$numero_online;

// retorno
return json_encode($array_retorno);

};

?>