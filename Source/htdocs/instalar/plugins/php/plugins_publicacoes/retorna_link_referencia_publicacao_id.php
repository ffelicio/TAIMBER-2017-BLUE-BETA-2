<?php

// retorna o link da referencia da publicacao por id
function retorna_link_referencia_publicacao_id($id, $conteudo){

// globals
global $variavel_campo;

// monta o link...
$link = PAGINA_INICIAL."?$variavel_campo[29]=$id";
$link = "<a href='$link' title='$conteudo'>$conteudo</a>";

// retorno
return $link;

};

?>