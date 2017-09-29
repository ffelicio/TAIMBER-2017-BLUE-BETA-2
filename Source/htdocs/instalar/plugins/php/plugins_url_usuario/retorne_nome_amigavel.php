<?php

// retorna o nome amigavel
function retorne_nome_amigavel($nome){

// convertendo
$nome = converte_minusculo($nome);
$nome = str_ireplace(" ", "_", $nome);
$nome = str_ireplace("-", null, $nome);
$nome = remove_acentos($nome);
$nome = str_ireplace("__", "_", $nome);

// retorno
return $nome;

};

?>