<?php

// retorne o array com amigos separados
function retorne_array_amigos_separados(){

// array de amigos
$array_amigos = retorne_array_amigos_usuario(null);

// contador
$contador = 0;

// separando por ids
for($contador == $contador; $contador <= count($array_amigos); $contador++){
	
	// dados
	$dados = $array_amigos[$contador];
	
	// atualiza o array de retorno
	$retorno[] = $dados[0];

};

// retorno
return $retorno;

};

?>