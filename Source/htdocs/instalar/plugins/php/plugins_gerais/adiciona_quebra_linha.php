<?php

// adiciona uma quebra de linha
function adiciona_quebra_linha($conteudo){

// globals
global $codigos_especiais;

// retorno
return str_ireplace("\n", $codigos_especiais[14], $conteudo);

};

?>