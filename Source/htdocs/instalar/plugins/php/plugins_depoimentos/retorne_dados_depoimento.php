<?php

// retorna os dados do depoimento
function retorne_dados_depoimento($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[13];

// query
$query = "select *from $tabela where id='$id';";

// dados
$dados = plugin_executa_query($query);
$dados = $dados["dados"][0];

// retorno
return $dados;

};

?>