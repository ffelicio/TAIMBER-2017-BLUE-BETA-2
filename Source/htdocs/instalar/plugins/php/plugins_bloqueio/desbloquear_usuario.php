<?php

// desbloqueia o usuario
function desbloquear_usuario(){

// globals
global $tabela_banco;

// id de amigo
$uidamigo = retorne_idusuario_request();

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query[0] = "delete from $tabela_banco[10] where uid='$idusuario' and uidamigo='$uidamigo' and uidbloqueou='$idusuario';";
$query[1] = "delete from $tabela_banco[10] where uid='$uidamigo' and uidamigo='$idusuario' and uidbloqueou='$idusuario';";

// desbloqueia usuario
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);
	
// array de retorno
$array_retorno["dados"] = null;

// retorno
return json_encode($array_retorno);

};

?>