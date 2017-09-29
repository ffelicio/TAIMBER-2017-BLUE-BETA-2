<?php

// retorna o link da publicacao via id
function retorna_link_publicacao_id($id){

// globals
global $variavel_campo;
global $idioma_sistema;

// monta o link...
$link = PAGINA_INICIAL."?$variavel_campo[29]=$id";
$link = "<a href='$link' title='$idioma_sistema[285]'>$idioma_sistema[285]</a>";

// retorno
return $link;

};

?>