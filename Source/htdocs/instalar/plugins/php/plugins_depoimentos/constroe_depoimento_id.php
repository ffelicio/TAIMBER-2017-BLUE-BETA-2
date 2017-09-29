<?php

// constroe um depoimento por id
function constroe_depoimento_id($id){

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[13] where id='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return constroe_depoimento($dados_query["dados"][0], 0, false);

};

?>