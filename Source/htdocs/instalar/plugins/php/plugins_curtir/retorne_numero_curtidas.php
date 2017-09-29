<?php

// retorna o numero de curtidas
function retorne_numero_curtidas($tipo_campo, $id_post){

// globals
global $tabela_banco;

// tabela
$tabela = retorne_tabela_comentario($tipo_campo);

// query
$query = "select *from $tabela_banco[9] where tabela_curtiu='$tabela' and id_post='$id_post';";

// dados de query
$dados = plugin_executa_query($query);

// retorno
return $dados["linhas"];

};

?>