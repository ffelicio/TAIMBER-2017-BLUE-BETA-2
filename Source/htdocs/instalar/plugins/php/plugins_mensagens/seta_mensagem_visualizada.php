<?php

// seta a mensagem como visualizada
function seta_mensagem_visualizada($uidamigo){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "update $tabela_banco[15] set visualizado='1' where uid='$uid' and uidamigo='$uidamigo';";

// seta as mensagens como visualizadas
plugin_executa_query($query);

};

?>