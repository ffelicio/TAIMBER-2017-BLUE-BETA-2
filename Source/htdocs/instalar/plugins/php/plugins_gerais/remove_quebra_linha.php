<?php

// remove uma quebra de linha
function remove_quebra_linha($conteudo){

// globals
global $codigos_especiais;

// removendo...
$conteudo = str_ireplace($codigos_especiais[14], "\n", $conteudo);
$conteudo = str_ireplace(trim($codigos_especiais[14]), "\n", $conteudo);

// retorno
return $conteudo;

};

?>