<?php

// trata o campo de tabela
function trata_campo_tabela($campo, $modo_instalar){

// remove espacoes, e substitui caracteres
$campo = trim($campo);
$campo = converte_minusculo($campo);
$campo = str_ireplace("-", "_", $campo);
$campo = str_ireplace(" ", "_", $campo);
$campo = str_ireplace(":", "_", $campo);

// valida o modo instalacao
if($modo_instalar == true){
	
	// monta o corpo da tabela
    $campo = "$campo text, ";

};

// retorno
return $campo;

};

?>