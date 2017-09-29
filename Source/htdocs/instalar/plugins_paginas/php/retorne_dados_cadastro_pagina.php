<?php

// retorna os dados de cadastro da pagina
function retorne_dados_cadastro_pagina($id){

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[18] where id='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0];

};

?>