<?php

// retorna o id de usuario de relacionamento
function retorne_idusuario_relacionamento($uid, $relacao){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[39];

// query
$query = "select *from $tabela where uid='$uid' and relacao='$relacao' and aceito='1';";

// dados de query
$dados_query = retorne_dados_query($query);

// retorno
return $dados_query[UIDAMIGO];

};

?>