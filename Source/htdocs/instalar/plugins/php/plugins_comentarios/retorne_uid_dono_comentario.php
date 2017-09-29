<?php

// retorna o id de usuario dono de comentario
function retorne_uid_dono_comentario($id){

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[7] where id='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// dados
$dados = $dados_query["dados"][0];

// retorno
return $dados[UID];

};

?>