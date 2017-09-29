<?php

// converte um item de perfil nome, sexo etc em número e vice versa
function converte_campo_perfil_numero_texto($conteudo){

// globals
global $idioma_sistema;
global $codigos_especiais;

// campo com sexos
$conteudo = trim(converte_minusculo($conteudo));

// sexos disponiveis
$conteudos_disponiveis = explode($codigos_especiais[12], trim(converte_minusculo($idioma_sistema[10])));

// valida se o sexo é modo numerico
if(is_numeric($conteudo) == true){
	
	// retorno
	return $conteudos_disponiveis[$conteudo];
	
};

// contador
$contador = 0;

// listando campos do perfil disponiveis
foreach($conteudos_disponiveis as $valor){
	
	// valida valor
	if($valor != null){
		
		// compara valores
		if($valor == $conteudo){
			
			// retorno
			return $contador;
			
		};
		
		// atualiza o contador
		$contador++;
		
	};

};

// retorno
return null;

};

?>