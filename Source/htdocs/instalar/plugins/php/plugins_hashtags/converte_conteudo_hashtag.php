<?php

// converte o conteudo em hashtags
function converte_conteudo_hashtag($conteudo){

// globals
global $codigos_especiais;
global $variavel_campo;

// url de hastag
$url = PAGINA_INICIAL."?$variavel_campo[2]=74&$variavel_campo[40]";

// codigo
$codigo = $codigos_especiais[11];

// procurando e convertendo
$conteudo = preg_replace("$codigo@(\w+)$codigo", "<a href=\"$url=$1\">$0</a>", $conteudo);
$conteudo = preg_replace("/$codigo(\w+)/", "<a href=\"$url=$1\">$0</a>", $conteudo);

// retorno
return $conteudo;

};

?>