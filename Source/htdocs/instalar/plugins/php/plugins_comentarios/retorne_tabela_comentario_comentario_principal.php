<?php

// retorna a tabela de comentario
function retorne_tabela_comentario_comentario_principal($dados){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[7];

// id de comentario principal
$id_post = $dados[ID_POST];

// query
$query = "select *from $tabela where id='$id_post';";

// dados de query
$dados = retorne_dados_query($query);

// retorno
return $dados[TABELA_COMENTARIO];

};

?>