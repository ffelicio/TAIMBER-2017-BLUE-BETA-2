<?php

// retorna o numero de musicas do usuario
function retorne_numero_musicas_usuario($uid){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[26];

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>