<?php

// retorna o numero de publicacoes de pagina
function retorne_numero_publicacoes_pagina($pagina){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// query
$query = "select *from $tabela where pagina='$pagina';";

// retorno
return retorne_numero_linhas_query($query);

};

?>