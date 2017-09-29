<?php

// retorna o link do comentario
function retorne_link_comentario($id){

// globals
global $variavel_campo;
global $idioma_sistema;

// url de comentario
$url_comentario = PAGINA_INICIAL."?$variavel_campo[9]=$id";

// html
$html = "
<a href='$url_comentario' title='$idioma_sistema[349]'>$idioma_sistema[348]</a>
";

// retorno
return $html;

};

?>