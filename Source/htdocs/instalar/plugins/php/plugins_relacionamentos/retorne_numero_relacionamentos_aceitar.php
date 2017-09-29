<?php

// retorna o numero de relacionamentoe a serem aceitos
function retorne_numero_relacionamentos_aceitar(){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[39];

// query
$query = "select *from $tabela where uid='$uid' and aceito='0' and visualizado='0';";

// retorno
return retorne_numero_linhas_query($query);

};

?>