<?php

// retorna o numero de todas as imagens do usuário
function retorne_numero_todas_imagens_usuario($uid){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[4];

// query
$query = "select *from $tabela where uid='$uid' and modo_chat='0';";

// retorno
return retorne_numero_linhas_query($query);

};

?>