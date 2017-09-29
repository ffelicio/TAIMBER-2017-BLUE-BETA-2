<?php

// exclui o conteudo de url
function exclui_conteudo_url($chave){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[29];

// query
$query = "delete from $tabela where chave='$chave' and uid='$uid';";

// publicando
plugin_executa_query($query);

// array de retorno
$array_retorno["dados"] = null;

// retorno
return json_encode($array_retorno);

};

?>