<?php

// retorna o numero de linhas de query
function retorne_numero_linhas_query($query){

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>