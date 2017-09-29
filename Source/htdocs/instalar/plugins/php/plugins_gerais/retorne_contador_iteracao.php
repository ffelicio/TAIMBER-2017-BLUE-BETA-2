<?php

// contador de iteracao
function retorne_contador_iteracao(){

// atualiza o contador
$_SESSION[SESSAO_CONTADOR_ITERACAO]++;

// retorno
return $_SESSION[SESSAO_CONTADOR_ITERACAO];

};

?>