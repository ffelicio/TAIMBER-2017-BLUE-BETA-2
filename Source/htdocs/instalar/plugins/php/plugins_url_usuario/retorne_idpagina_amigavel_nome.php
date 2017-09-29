<?php

// retorna o id da pagina amigavel via nome
function retorne_idpagina_amigavel_nome($nome_amigavel){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[28];

// query
$query = "select *from $tabela where nome_amigavel='$nome_amigavel' and modo='1';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0][PAGINA];

};

?>