<?php

// retorna a idade do usuario
function retorne_idade_usuario($data){

// globals
global $codigos_especiais;

// ano atual
$dia_atual = date("d");
$mes_atual = date("m");
$ano_atual = date("Y");

// datas
$data = explode($codigos_especiais[10], $data);

// dia, mes e ano
$dia = $data[0];
$mes = $data[1];
$ano = $data[2];

// valida datas
if($dia == null or $mes == null or $ano == null or $ano == $ano_atual){
	
	// retorno nulo
	return null;
	
};

// idade
$idade = $ano_atual - $data[2];

// valida idade correta
if($dia_atual < $dia or $mes_atual < $mes){
	
	// retrocede idade
	$idade--;
	
};

// retorna diferenca
return $idade;

};

?>