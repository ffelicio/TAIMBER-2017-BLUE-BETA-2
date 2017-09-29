<?php

// converte codigos especiais
function converte_codigos_especiais($conteudo){

// globals
global $codigos_especiais;

// convertendo codigos
$conteudo = str_ireplace($codigos_especiais[0], $codigos_especiais[2], $conteudo);
$conteudo = str_ireplace($codigos_especiais[1], $codigos_especiais[3], $conteudo);
$conteudo = str_ireplace($codigos_especiais[4], $codigos_especiais[6], $conteudo);
$conteudo = str_ireplace($codigos_especiais[5], $codigos_especiais[7], $conteudo);
$conteudo = str_ireplace($codigos_especiais[8], $codigos_especiais[9], $conteudo);
$conteudo = str_ireplace("\n", "<br>", $conteudo);
$conteudo = stripslashes($conteudo);

// retorno
return $conteudo;

};

?>