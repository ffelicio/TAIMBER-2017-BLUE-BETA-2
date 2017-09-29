<?php

// adiciona quebra de linha em textarea
function adiciona_quebra_linha_textarea($conteudo){

# \r serve para quebra de linha em textarea

// retorno
return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\r\r", $conteudo);

};

?>