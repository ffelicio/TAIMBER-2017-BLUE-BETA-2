<?php

// retorna os dados da publicacao
function retorne_dados_publicacao($id_post){

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[5] where id='$id_post';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0];

};

?>