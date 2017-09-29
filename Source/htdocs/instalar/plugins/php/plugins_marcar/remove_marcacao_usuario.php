<?php

// remove a marcacao de usuario
function remove_marcacao_usuario($id, $tabela){

// globals
global $tabela_banco;

// query
$query = "delete from $tabela_banco[14] where tabela_referencia='$tabela' and idpost='$id';";

// removendo marcacoes
plugin_executa_query($query);

// remove as notificacoes
remove_notifica(null, $id, $tabela, false);

};

?>