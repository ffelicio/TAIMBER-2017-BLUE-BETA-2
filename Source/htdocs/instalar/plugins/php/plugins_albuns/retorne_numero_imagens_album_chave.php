<?php

// retorna o numero de imagens de um album pela chave
function retorne_numero_imagens_album_chave($chave){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[4];

// query
$query = "select *from $tabela where chave='$chave';";

// retorno
return retorne_numero_linhas_query($query);

};

?>