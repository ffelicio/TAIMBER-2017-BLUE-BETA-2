<?php

// retorna se o nome de url amigavel ja existe
function retorne_nome_url_amigavel_existe($nome, $modo){

// modo 0 usuario
// modo 1 pagina

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[28];

// nome amigavel
$nome = retorne_nome_amigavel($nome);

// query
$query = "select *from $tabela where nome_amigavel='$nome' and modo='$modo';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"] > 0;

};

?>