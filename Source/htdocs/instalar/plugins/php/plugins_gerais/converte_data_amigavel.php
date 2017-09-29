<?php

// converte data numero para amigavel 
function converte_data_amigavel($modo_hoje, $data){

// globals
global $semana_idioma;
global $mes_extenso_idioma;
global $idioma_sistema;

// valida data
if($data == null){

    // retorno nulo
    return null;

};

// diferença de data de conexao
$diferenca = diferenca_data_conexao($data);

// calcula direrença
if($diferenca <= 30){
	
	// retorno
	return $idioma_sistema[500];

};

// calcula direrença
if($diferenca <= 60){
	
	// retorno
	return $idioma_sistema[504];

};

// calcula direrença
if($diferenca <= 3600){
	
	// retorno
	return $idioma_sistema[501];

};

// calcula direrença
if($diferenca <= 86400){
	
	// retorno
	return $idioma_sistema[502];

};

// calcula direrença
if($diferenca <= 172800){
	
	// retorno
	return $idioma_sistema[503];

};

// obtendo dados de array de data
$data_explode = explode("-", $data); 

// valida dia, mes, ano
if($data_explode[0] == null or $data_explode[1] == null or $data_explode[2] == null){

    // retorno nulo
    return null;

};

// obtem a abreviacao do mes
$time = mktime(0, 0, 0, $data_explode[1]);

// nome abreviado do mes
$nome_mes = strftime("%b", $time);

// numero do dia da data
$numero_dia = $data_explode[0];

// obtendo dados de data 
$mes = $nome_mes; // mes
$dia = $data_explode[0]; // dia
$ano = $data_explode[2]; // ano

// valida se e o mesmo dia de hoje
if($dia == Date("d") and $modo_hoje == true){

    // retorna hoje
    return $idioma_sistema[135];	
	
};

// remove a parte de horas
$ano = explode(":", $ano);
$ano = $ano[0];
$ano = explode(" ", $ano);
$ano = $ano[0];

// data completa
$dia_semana = date('w', mktime(0,0,0, $data_explode[1], $data_explode[0], $data_explode[2]));

// data completa
$data_completa = $semana_idioma[$dia_semana]." {$dia} $idioma_sistema[80] ".$mes_extenso_idioma[$mes]." $idioma_sistema[80] {$ano}";

// retorno
return $data_completa;

};

?>