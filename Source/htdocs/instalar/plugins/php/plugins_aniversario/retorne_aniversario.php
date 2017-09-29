<?php

// retorna se uma data e aniversario
function retorne_aniversario($data){

// globals
global $codigos_especiais;

// dia e mes atual
$dia_atual = date("d");
$mes_atual = date("m");

// datas
$data = explode($codigos_especiais[10], $data);

// dia e mes
$dia = $data[0];
$mes = $data[1];

// valida valores basicos
if($dia == null or $mes == null){

	// nao
	return false;	
};

// valida aniversario
if($dia_atual == $dia and $mes_atual == $mes){
	
	// sim
	return true;
	
}else{
	
	// nao
	return false;
	
};

};

?>