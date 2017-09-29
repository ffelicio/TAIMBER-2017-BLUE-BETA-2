<?php

// exclui todas as mensagens
function excluir_todas_mensagens(){

// globals
global $tabela_banco;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// tabela
$tabela[0] = $tabela_banco[15];
$tabela[1] = $tabela_banco[4];

// query
$query[0] = "delete from $tabela[0] where uid='$idusuario';";
$query[1] = "delete from $tabela[1] where uid='$idusuario' and modo_chat='1';";

// exclui mensagens
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

// exclui as pastas com imagens do chat do usuario
excluir_pastas_subpastas(retorne_pasta_usuario($idusuario, 4, true), false);

};

?>