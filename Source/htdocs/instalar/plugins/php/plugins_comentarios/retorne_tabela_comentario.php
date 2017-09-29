<?php

// retorna a tabela de comentario
function retorne_tabela_comentario($numero_tabela){

// primeiro informa o numero ta tabela
// se nada for encontrado, entao o scipt assumeque deve retornar o numero da tabela ao inves do nome

// globals
global $tabela_banco;

// tabela
switch($numero_tabela){

    case 1:	
    $retorno = $tabela_banco[5];
	break;

	case 2:	
    $retorno = $tabela_banco[4];
	break;
	
	case 3:
	$retorno = $tabela_banco[7];
	break;
	
};

// valida retorno
if($retorno == null){
	
	// entao pega pelo nome da tabela o seu numero
	$nome_tabela = $numero_tabela;
	
	// tabela
	switch($nome_tabela){
		
		case $tabela_banco[5]:
		$retorno = 1;
		break;
		
		case $tabela_banco[4]:
		$retorno = 2;
		break;
		
		case $tabela_banco[7]:
		$retorno = 3;
		break;
		
	};
	
};

// retorno
return $retorno;

};


?>