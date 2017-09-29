<?php

// retorna a extensao da string
function retorne_extensao_string($conteudo){

// retorno
return substr($conteudo, strlen($conteudo) - 4, strlen($conteudo));

};

?>