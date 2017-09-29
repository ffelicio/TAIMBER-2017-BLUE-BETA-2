<?php

// remove notificacoes duplicadas de comentario
function remove_notifica_duplicados_comentario($id){

// globals
global $tabela_banco;

// id de usuario
$idusuario = retorne_idusuario_logado();

// query
$query[0] = "delete from $tabela_banco[24] where uid='$idusuario' and idpost='$id' and tabela_acao='$tabela_banco[7]';";
$query[1] = "delete from $tabela_banco[24] where uidamigo!='$idusuario' and idpost='$id' and tabela_acao='$tabela_banco[7]';";

// executa query
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

};

?>