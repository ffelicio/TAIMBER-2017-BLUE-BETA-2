<?php

// retorna o id de campo md5
function retorne_idcampo_md5(){

// gera o id de campo
$idcampo = codifica_md5(data_atual().retorne_contador_iteracao());

// retorno
return LOGOTIPO_INICIO_MD5.$idcampo;

};

?>