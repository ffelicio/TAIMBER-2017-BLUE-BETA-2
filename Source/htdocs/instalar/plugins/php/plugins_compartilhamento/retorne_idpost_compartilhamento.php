<?php

// retorna o id de post de compartilhamento
function retorne_idpost_compartilhamento($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// query
$query = "select *from $tabela where id_compartilhado='$id' limit 1;";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0]["id"];

};

?>