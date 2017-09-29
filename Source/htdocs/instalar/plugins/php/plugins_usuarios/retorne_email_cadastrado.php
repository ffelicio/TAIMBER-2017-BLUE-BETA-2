<?php

// retorna se o email esta cadastrado
function retorne_email_cadastrado($email){

// globals
global $tabela_banco;

// query
$query[0] = "select *from $tabela_banco[0] where e_mail='$email';";

// array de dados
$array_dados = plugin_executa_query($query[0]);

// retorno
return $array_dados["linhas"] == 1;

};

?>