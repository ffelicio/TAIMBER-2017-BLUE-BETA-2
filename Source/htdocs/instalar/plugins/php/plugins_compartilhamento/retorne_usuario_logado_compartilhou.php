<?php

// retorna se o usuario logado ja compartilhou
function retorne_usuario_logado_compartilhou($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "select *from $tabela where id_compartilhado='$id' and uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"] >= 1;

};

?>