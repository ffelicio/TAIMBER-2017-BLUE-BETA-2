<?php

// retorna se o usuario logado e dono da publicacao
function retorna_usuario_logado_dono_publicacao($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// uid
$uid = retorne_idusuario_logado();

// query
$query = "select *from $tabela where id='$id' and uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"] == 1;

};

?>