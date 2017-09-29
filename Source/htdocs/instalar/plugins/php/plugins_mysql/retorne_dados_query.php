<?php

// retorna os dados de query
function retorne_dados_query($query){

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0];

};

?>