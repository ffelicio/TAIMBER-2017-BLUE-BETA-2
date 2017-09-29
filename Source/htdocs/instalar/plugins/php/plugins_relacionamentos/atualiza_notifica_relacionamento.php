<?php

// atualiza as notificacoes de relacionamento
function atualiza_notifica_relacionamento(){

// globals
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;

// url de inicio
$url_inicio = $pagina_inicial."?$variavel_campo[2]=109";

// numero de relacionamentos a serem aceitos
$numero_aceitar = retorne_tamanho_resultado(retorne_numero_relacionamentos_aceitar());

// links
$link[0] = "<a href='$url_inicio' title='$idioma_sistema[539]'>$idioma_sistema[539] - $numero_aceitar</a>";

// array de retorno
$array_retorno["dados"] = $link[0];

// retorno
return json_encode($array_retorno);

};

?>