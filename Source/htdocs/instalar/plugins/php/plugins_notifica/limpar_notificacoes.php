<?php

// limpa as notificacoes
function limpar_notificacoes(){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "delete from $tabela_banco[24] where uidamigo='$uid';";

// limpando as notificacoes
plugin_executa_query($query);

};

?>