<?php

// retorna o modo sexo do usuario
function retorne_modo_sexo_usuario($conteudo){

// globals
global $idioma_sistema;
global $codigos_especiais;

// campo com sexos
$conteudo = trim(converte_minusculo($conteudo));

// sexos disponiveis
$conteudos_disponiveis = explode($codigos_especiais[12], trim(converte_minusculo($idioma_sistema[36])));

// valida se o sexo é modo numerico
if(is_numeric($conteudo) == true){
	
	// valida sexo
	switch($conteudo){
		
		case 1:
		return $conteudos_disponiveis[1];
		break;
		
		case 2:
		return $conteudos_disponiveis[2];
		break;
		
		default:
		return null;
		
	};

};

// valida sexo
if($conteudo == $conteudos_disponiveis[1]){
	
	// retorna masculino
	return 1;
	
};

// valida sexo
if($conteudo == $conteudos_disponiveis[2]){
	
	// retorna feminino
	return 2;
	
};

// retorno
return null;

};

?>