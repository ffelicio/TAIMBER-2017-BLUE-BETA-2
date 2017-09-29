<?php

// retorna o numero de comentarios
function retorne_numero_comentarios($tipo_campo, $id_post){

// globals
global $tabela_banco;

// tabela
$tabela = retorne_tabela_comentario($tipo_campo);

// query
$query = "select *from $tabela_banco[7] where id_post='$id_post' and tabela_comentario='$tabela';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>