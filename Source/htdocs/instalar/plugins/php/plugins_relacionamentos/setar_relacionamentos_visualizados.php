<?php

// seta os relacionamentos como visualizados
function setar_relacionamentos_visualizados(){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[39];

// query
$query = "update $tabela set visualizado='1' where uid='$uid';";

// setando como visualizados
plugin_executa_query($query);

};

?>