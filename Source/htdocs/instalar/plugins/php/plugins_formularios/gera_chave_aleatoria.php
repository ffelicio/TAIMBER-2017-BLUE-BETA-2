<?php

// retorna uma chave aleatoria
function gera_chave_aleatoria(){

// atualiza a chave de sessão
$_SESSION[SESSAO_CHAVE_ALEATORIA] += 1;

// retorno
return codifica_md5("md5_chave_aleatoria_".$_SESSION[SESSAO_CHAVE_ALEATORIA].data_atual());

};

?>