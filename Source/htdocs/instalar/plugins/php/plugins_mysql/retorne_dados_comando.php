<?php

// retorna os dados do comando
function retorne_dados_comando($comando){

// dados
$dados = mysqli_fetch_array($comando, MYSQLI_ASSOC);

// retorno
return $dados;

};

?>