<?php

// retorna o id de conteudo de url
function retorne_id_conteudo_url($chave){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[29];

// query
$query = "select *from $tabela where chave='$chave';";

// dados de query
$dados_query = plugin_executa_query($query);

// separa os dados
$dados = $dados_query["dados"][0];

// retorno
return $dados["id"];

};

?>