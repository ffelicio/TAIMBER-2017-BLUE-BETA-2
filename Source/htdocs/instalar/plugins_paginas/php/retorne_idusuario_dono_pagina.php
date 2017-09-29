<?php

// retorna o id de usuario dono da pagina
function retorne_idusuario_dono_pagina($id){

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[18] where id='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// dados
$dados = $dados_query["dados"][0];

// retorno
return $dados[UID];

};

?>