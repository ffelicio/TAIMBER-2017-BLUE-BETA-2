<?php

// limpa as solicitações de relacionamentos
function limpar_solicitacoes_relacionamentos(){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[39];

// query
$query = "delete from $tabela where (uid='$uid' or uidamigo='$uid') and aceito='0';";

// removendo solicitações
plugin_executa_query($query);

};

?>