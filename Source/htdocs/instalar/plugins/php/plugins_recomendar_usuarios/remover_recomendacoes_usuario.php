<?php

// remove as recomendacoes de usuario
function remover_recomendacoes_usuario(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[37];

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "delete from $tabela where uid='$uid';";

// executa query
plugin_executa_query($query);

};

?>