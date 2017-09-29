<?php

// trata o html para salvar em banco de dados
function trata_html_requeste($conteudo){

// remove espaços em branco
$conteudo = trim($conteudo);

// adiciona uma barra invertida em caracteres que precisam ser escapados
$conteudo = addslashes($conteudo);

// remove estilos css
$conteudo = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $conteudo);

// remove scripts JavaScript
$conteudo = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $conteudo);

// remove divs, spans, e quebras de linhas br
$conteudo = preg_replace("/<\/?div[^>]*\>/i", "", $conteudo); 
$conteudo = preg_replace("/<\/?span[^>]*\>/i", "", $conteudo);
$conteudo = preg_replace("/<\/?br[^>]*\>/i", "", $conteudo); 

// converte codigos html para guardar no banco de dados
$conteudo = htmlentities($conteudo);

// retorno
return $conteudo;

};

?>