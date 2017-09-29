<?php

// retorna o numero de hashtags
function retorne_numero_hashtags($hashtag){

// global
global $tabela_banco;
global $codigos_especiais;

// tabela
$tabela = $tabela_banco[5];

// query
$query = "select *from $tabela where texto like '%$codigos_especiais[11]$hashtag%';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>